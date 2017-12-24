<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SEOMeta;
use OpenGraph;
use DB;
use Log;
use Auth;
use Hash;
use Notification;
use DateTime;
use Cookie;
use Session;
use App\Notifications\VerifyUser;
use App\Config;
use App\User;
use App\Role;
use App\Product;
use App\ProductCategory;
use App\ProductType;
use App\Producer;
use App\ShoppingCart;
use App\ShoppingCartDetail;
use App\Article;
use App\ArticleCategory;
use App\ArticleType;
use App\Http\Requests\Page\PageRequest;
use App\Mail\PurchaseOrder;
use App\Banner;
use App\BannerCategory;
use App\ProjectCategory;
use App\ProjectType;
use App\Project;
use App\Testimonial;
use App\Contact;
use App\Tag;
use App\Notifications\ContactRequest;

// to return raw query
//DB::enableQueryLog();
//dd(DB::getQueryLog());

class PageController extends Controller
{
	public function __construct()
    {
    	/*$mainMenus = ArticleCategory::where('published', 1)->where('parent_id', 0)->orderBy('priority')->get();
		$articleMasterTop = ArticleType::findByKey('master-top')->first()->articles()->where('published', 1)->orderBy('published_at', 'desc')->take(6)->get();
		$articleSliderFooter = ArticleType::findByKey('slider-footer')->first()->articles()->where('published', 1)->orderBy('published_at', 'desc')->take(6)->get();
		$myPublic = ArticleCategory::findByKey('cong-dong')->first();
		$logoBannerCategory = BannerCategory::findByKey('logo-banner')->first();
		$logoBanner = $logoBannerCategory ? $logoBannerCategory->banners()->first() : null;
        view()->share('mainMenus', $mainMenus);
        view()->share('articleMasterTop', $articleMasterTop);
        view()->share('articleSliderFooter', $articleSliderFooter);
        view()->share('logoBannerCategory', $logoBannerCategory);
        */
        $newArticleType = ArticleType::findByKey('moi-nhat')->first();
        $parentArticleCategories = ArticleCategory::where('published', 1)->where('parent_id', 0)->orderBy('priority')->get();
        $lastestNews = Article::where('published', 1)->orderBy('published_at', 'desc')->take(5)->get();
        view()->share('newArticleType', $newArticleType);
        view()->share('parentArticleCategories', $parentArticleCategories);
        view()->share('lastestNews', $lastestNews);
        //dd($parentArticleCategories);
    }
	public function master( $view, $viewCompact){
		return view($view, compact('parentArticleCategories'))->with($viewCompact);
	}

	public function underConstruction()
	{
		return view('frontend.pages.underconstruction');
	}

	// for multi language site
	public function locale($locale)
	{
		Session::put('language', $locale);
		return back();
	}

	public function index()
	{
		$this->setMetadata();
		$projectSlideshow = ProjectCategory::findByKey('slideshow-chinh')->first()->projects()->orderBy('published_at', 'desc')->take(5)->get();
		$duAnNoiBat = ProjectCategory::findByKey('du-an-noi-bat')->first()->projects()->take(4)->get();
		$camNhanKh = Testimonial::where('published', 1)->orderBy('priority')->take(10)->get();
		$duAnMoiNhat = ProjectCategory::findByKey('du-an-moi-nhat')->first()->projects()->take(4)->get();
		$tinDuAnMoiNhat = ArticleType::findByKey('moi-nhat')->first()->articles()->where('project_id', '>', 0)->take(4)->get();
		$tinDuAnXemNhieu = ArticleType::findByKey('xem-nhieu')->first()->articles()->where('project_id', '>', 0)->take(4)->get();
		$chuyenMuc = Article::findByKey('chuyen-muc')->first();
		$doiTacLanding = Article::findByKey('doi-tac-landing')->first();
		$news = ArticleType::findByKey('moi-nhat')->first()->articles()->where('published', 1)->orderBy('published_at', 'desc')->take(10)->get();
		return $this->master('frontend.pages.index', compact('projectSlideshow', 'duAnNoiBat', 'duAnMoiNhat', 'camNhanKh', 'tinDuAnMoiNhat', 'tinDuAnXemNhieu', 'chuyenMuc', 'doiTacLanding', 'news'));
	}

	public function products($key = '')
	{
		$limit = Config::getValueByKey('rows_per_page_product');
		$category = null;
		$products = [];

		// fillter
		//tag=tagid&producttype=producttypeid&orderby=price-desc
		$request = request();

		$orderBy = explode('-', $request->query('orderby', ''));

		$query = Product::where('published', 1);

		if($request->query('tag', '') != ''){
			$query->whereHas('tags', function ($query) use ($request) {
				$query->where('id', $request->query('tag', ''));
			});
		}

		if($request->query('producttype', '') != ''){
			$query->whereHas('productTypes', function ($query) use ($request) {
				$query->where('id', $request->query('producttype', ''));
			});
		}

		// all products
		if ($key == '') {
			$this->setMetadata('Sản phẩm', 'allproducts');

			if (count($orderBy) == 2) {
				$query->orderBy($orderBy[0], $orderBy[1]);
			}
			$products = $query->orderBy('id', 'desc')->paginate($limit);
		}
		else{
			$category = ProductCategory::findByKey($key)->where('published', 1)->first();
			if($category == null){
				abort(404);
			}

			$site_title = $category->name;
			$site_name = Config::getValueByKey('site_name');
			$facebook_page = Config::getValueByKey('facebook_page');
			SEOMeta::setTitle($site_title);
			SEOMeta::setDescription($category->meta_description);
			SEOMeta::setKeywords([$category->meta_keywords]);
			SEOMeta::addMeta('copyright', $site_name);
			SEOMeta::addMeta('author', $site_name);
			SEOMeta::addMeta('robots', 'all');
			SEOMeta::addMeta('revisit-after', '1 days');
			SEOMeta::addMeta('article:author', $facebook_page);
			SEOMeta::addMeta('article:publisher', $facebook_page);
			SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
			SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
			SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
			SEOMeta::addAlternateLanguage('en-us', $category->getLink());

			OpenGraph::setTitle($site_title);
			OpenGraph::setDescription($category->meta_description);
			OpenGraph::setUrl($category->getLink());
			OpenGraph::setSiteName($site_name);
			OpenGraph::addProperty('type', 'website');
			OpenGraph::addProperty('locale', 'vi_VN');
			OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
			foreach ($category->getVisibleAttachments() as $attachment) {
				OpenGraph::addImage($attachment->getLink());
			}
			OpenGraph::addProperty('image:width', 1200);
			OpenGraph::addProperty('image:height', 628);

			$query->whereHas('productCategories', function ($query) use ($category) {
				if (count($category->childrens()->where('published', 1)->get()) > 0) {
					$query->whereIn('id', $category->childrens()->where('published', 1)->pluck('id')->toArray());
				}
				else{
					$query->where('id', $category->id);
				}
			});

			if (count($orderBy) == 2) {
				$query->orderBy($orderBy[0], $orderBy[1]);
			}

			$products = $query->orderBy('id', 'desc')->paginate($limit);
		}

		if ($request->ajax()) {
			$products->load('attachments', 'productCategories', 'tags');
			return response()->json($products->toArray());
		}

		return view('frontend.pages.products', compact('category', 'products'));
	}

	public function producer($key)
	{
		$producer = Producer::findByKey($key)->where('published', 1)->first();
		if($producer == null){
			abort(404);
		}

		$site_title = $producer->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($producer->meta_description);
		SEOMeta::setKeywords([$producer->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $producer->getLink());
		SEOMeta::addAlternateLanguage('en-us', $producer->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($producer->meta_description);
		OpenGraph::setUrl($producer->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		/*
		foreach ($producer->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		*/

		$limit = Config::getValueByKey('rows_per_page_product');
		$products = $producer->products()->where('published', 1)->orderBy('id', 'desc')->paginate($limit);

		return view('frontend.pages.products', compact('producer', 'products'));
	}

	public function product($categorykey, $key)
	{
		$category = ProductCategory::where('key', $categorykey)->where('published', 1)->first();
		if ($category == null) {
			abort(404);
		}
		$product = $category->products()->where('key', $key)->where('published', 1)->first();
		if ($product == null) {
			abort(404);
		}

		// metadata
		$site_title = $product->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($product->meta_description);
		SEOMeta::setKeywords([$product->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $product->getLink());
		SEOMeta::addAlternateLanguage('en-us', $product->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($product->meta_description);
		OpenGraph::setUrl($product->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'product');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($product->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata

		// related products
		$relatedProducts = $product->relatedProducts()->where('published', 1)->take(4)->get();

		return view('frontend.pages.product',compact('product', 'relatedProducts'));
		
		//return response()->view('frontend.pages.product',compact('product', 'shippingInformation', 'relatedProducts', 'viewedProducts'))->withCookie(cookie('ViewedProducts', $cookieViewedProducts, 43200, '/'));
	}

	public function articles($key)
	{
		$category = ArticleCategory::where('key', $key)->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$articles = $category->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		if($category->menu_display){
			return view('frontend.pages.services', compact('articles', 'category'));
		}
		return view('frontend.pages.articles', compact('articles', 'category'));
	}

	public function tag($key)
	{
		$tag = Tag::where('key', $key)->where('published', 1)->first();

		if($tag == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $tag->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($tag->meta_description);
		SEOMeta::setKeywords([$tag->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $tag->getLink());
		SEOMeta::addAlternateLanguage('en-us', $tag->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($tag->meta_description);
		OpenGraph::setUrl($tag->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($tag->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$articles = $tag->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.tag', compact('articles', 'tag'));
	}

	public function articleTypes($key = 'game-moi')
	{
		$type = ArticleType::where('key', $key)->where('published', 1)->first();

		if($type == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $type->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($type->meta_description);
		SEOMeta::setKeywords([$type->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $type->getLink());
		SEOMeta::addAlternateLanguage('en-us', $type->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($type->meta_description);
		OpenGraph::setUrl($type->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($type->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$articles = $type->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.tag', compact('articles', 'type'));
	}

	public function latestPosts()
	{
		$this->setMetadata();

		$limit = Config::getValueByKey('rows_per_page_article');
		$articles = Article::where('published', 1)->where('key', '<>', 'footer')->orderBy('id', 'desc')->paginate($limit);
		$type = new ArticleType;
		$type->name = 'Tin mới';
		
		return view('frontend.pages.tag', compact('articles', 'type'));
	}

	public function article($categorykey, $key)
	{
		$article = Article::findByKey($key)->first();
		if ($article == null) {
			abort(404);
		}
		// $category = $article->firstArticleCategories();
		$category = ArticleCategory::findByKey($categorykey)->first();
		if ($category == null) {
			abort(404);
		}
		$this->setMetadataArticle($article, $category);

		$breadcrumb = '<li><a href="'.$category->getLink().'">'.$category->name.'</a></li>
				    <li class="active">'.$article->name.'</li>';
		return $this->master('frontend.pages.article', compact('article', 'category', 'breadcrumb'));
	}


	public function tuyenDung()
	{
		$article = Article::findByKey('tuyen-dung')->first();
		if ($article == null) {
			abort(404);
		}
		$category = null;
		$this->setMetadataArticle($article, $category);

		$breadcrumb = '<li><a href="'.$article->getLink().'">'.$article->name.'</a></li>';
		return $this->master('frontend.pages.article', compact('article', 'category', 'breadcrumb'));
	}
	

	public function projects($key)
	{
		$category = ProjectCategory::where('key', $key)->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$projects = $category->projects()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.projects', compact('projects', 'category'));
	}

	public function project($categorykey, $key)
	{

		$projectType = ProjectType::where('key', $categorykey)->where('published', 1)->first();
		
		if ($projectType == null) {
			abort(404);
		}
		$project = $projectType->projects()->where('key', $key)->where('published', 1)->first();
		if ($project == null) {
			abort(404);
		}

		
		// metadata
		$site_title = $project->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($project->meta_description);
		SEOMeta::setKeywords([$project->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:published_time', $project->published_at, 'property');
		SEOMeta::addMeta('article:author', $facebook_page, 'property');
		SEOMeta::addMeta('article:publisher', $facebook_page, 'property');
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $project->getLink());
		SEOMeta::addAlternateLanguage('en-us', $project->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($project->meta_description);
		OpenGraph::setUrl($project->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'article');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($project->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata
		$breadcrumb = '<li><a href="'.$project->getLink().'">'.$project->name.'</a></li>';
		return $this->master('frontend.pages.project', compact('project', 'projectType', 'breadcrumb'));
	}

	public function gallery()
	{
		$category = BannerCategory::where('key', 'thu-vien')->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		//SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		//SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		//OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		/*
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		*/
		$banners = $category->banners()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.gallery', compact('banners'));
	}

	public function videoGames()
	{
		$category = BannerCategory::where('key', 'video-games')->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		//SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		//SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		//OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		/*
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		*/
		$videos = $category->banners()->where('published', 1)->orderBy('id','desc')->paginate($limit);
		$video = $videos->first();

		return view('frontend.pages.videos', compact('video', 'videos'));
	}

	public function viewVideoGames($key)
	{
		$category = BannerCategory::where('key', 'video-games')->where('published', 1)->first();

		if($category == null)
			abort(404);

		$video = $category->banners()->where('key', $key)->where('published', 1)->first();
		if ($video == null) {
			abort(404);
		}

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $video->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($video->meta_description);
		SEOMeta::setKeywords([$video->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $video->getLink());
		SEOMeta::addAlternateLanguage('en-us', $video->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($video->meta_description);
		OpenGraph::setUrl($video->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($video->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$videos = $category->banners()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.videos', compact('video', 'videos'));
	}

	public function search(PageRequest $request)
	{
		$this->setMetadata('Tìm kiếm', 'search');

		$articles = [];
		$limit = Config::getValueByKey('rows_per_page_article');

		$request = request();
		$keyword = strip_tags($request->input('keyword', ''));
		
		$queryArticle = Article::where('published', 1);
		$queryArticle->whereTranslationLike('name', '%'. $keyword .'%');
		$queryArticle->orderBy('id', 'desc');
		$blogBigArticles = $queryArticle->paginate($limit);

		$newPosts13 = Article::where('published', 1)->orderBy('published_at', 'desc')->take(5)->get();
		$category = null;
		if(count($blogBigArticles) > 0){
			$category = $blogBigArticles[0]->firstArticleCategories();
		} else {
			$category = ArticleCategory::where('published', 1)->orderBy('priority')->first();	
		}
		$parentCategory = $category->parent()->first();
		if($parentCategory == null)
			$parentCategory = ArticleCategory::where('published', 1)->orderBy('priority')->first();

		//return view('frontend.pages.search', compact('articles'));
		return $this->master('frontend.pages.search', compact('blogBigArticles', 'category', 'parentCategory', 'newPosts13'));
	}

	public function shoppingCart()
	{
		$this->setMetadata('Giỏ hàng của bạn', 'shopping.cart');
		$cart = new ShoppingCart;
		$cartDetails = [];
		if (isset($_COOKIE['ShoppingCartData'])) {
			foreach (json_decode($_COOKIE['ShoppingCartData'], true) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				array_push($cartDetails, $cartDetail);
			}
		}
		$cart->cartDetails = $cartDetails;

		return view('frontend.pages.shoppingcart', compact('cart'));
	}

	public function paymentInfo()
	{		
		if (isset($_COOKIE['ShoppingCartData'])) {
			$this->setMetadata('Thông tin thanh toán', 'payment.info');
			$cart = new ShoppingCart;
			$cartDetails = [];
			foreach (json_decode($_COOKIE['ShoppingCartData'], true) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				array_push($cartDetails, $cartDetail);
			}
			$cart->cartDetails = $cartDetails;
			return view('frontend.pages.paymentinfo', compact('cart'));
		}
		return redirect()->route('shopping.cart');
	}

	public function purchase(PageRequest $request)
	{
		$cart = new ShoppingCart;
		DB::transaction(function () use ($cart, $request) {
			$cart->code = uniqid();
			$cart->customer_name = $request->input('ShoppingCart.customer_name', '');
			$cart->customer_phone = $request->input('ShoppingCart.customer_phone', '');
			$cart->customer_email = $request->input('ShoppingCart.customer_email', '');
			$cart->customer_address = $request->input('ShoppingCart.customer_address', '');
			$cart->customer_note = $request->input('ShoppingCart.customer_note', '');
			$cart->shipping_fee = Config::getValueByKey('default_shipping_fee');
			
			if (!is_null(Auth::user())) {
				$cart->customer_id = Auth::user()->id;
				$cart->created_by = Auth::user()->id;
			}

			$cart->save();

			$cartDetails = [];
			foreach ($request->input('ShoppingCart.cartDetails', []) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				$cartDetail->product_price = $cartDetail->product->getLatestPrice();
				array_push($cartDetails, $cartDetail);
			}
			$cart->cartDetails()->saveMany($cartDetails);
		});

		Mail::to($cart->customer_email)
		->cc(Config::getValueByKey('address_received_mail'))
		->send(new PurchaseOrder($cart));

		return redirect()->route('purchase.success')->withCookie(Cookie::forget('ShoppingCartData'));
	}

	public function purchaseSuccess()
	{
		$this->setMetadata('Mua hàng thành công', 'purchase.success');

		return view('frontend.pages.purchasesuccess');
	}

	public function register()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Đăng ký', 'user.register');

		return view('frontend.pages.register');
	}

	public function createUser(PageRequest $request)
	{
		$password = $request->input('User.password');
		$user = new User;
		DB::transaction(function () use ($user, $password, $request) {
			$user->last_name = strip_tags($request->input('User.last_name', ''));
			$user->first_name = strip_tags($request->input('User.first_name', ''));
			$user->birthday = strip_tags($request->input('User.birthday', ''));
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = $request->input('User.gender', '');
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = strip_tags($request->input('User.job_title', ''));
			$user->mobile_phone = strip_tags($request->input('User.mobile_phone', ''));
			$user->home_phone = strip_tags($request->input('User.home_phone', ''));
			$user->address = strip_tags($request->input('User.address', ''));
			$user->website = strip_tags($request->input('User.website', ''));
			$user->facebook = strip_tags($request->input('User.facebook', ''));
			$user->email = strip_tags($request->input('User.email', ''));
			$user->password = Hash::make($password);
			$user->confirmation_code = str_random(30);
			$user->type = 0;	// normal user
			$user->save();

			//Role::findByKey('Normal')->first()->users()->attach($user);
		});

		Notification::send($user, new VerifyUser($user));

		return redirect()->back()->with('status', 'Đăng ký tài khoản thành công! Vui lòng kích hoạt tài khoản với email bạn nhận được.');
	}

	public function createVerify($confirmationcode)
	{
		if(!$confirmationcode)
		{
			abort(404);
		}

		$user = User::whereConfirmationCode($confirmationcode)->first();

		if (!$user)
		{
			abort(404);
		}

		$user->active = 1;
		$user->confirmed = 1;
		$user->confirmation_code = null;
		$user->save();

		if ($user->type) {
			return redirect()->route('backend.login')->with('status', 'Tài khoản đã kích hoạt thành công. Vui lòng dùng chức năng khôi phục mật khẩu để tạo mật khẩu cho tài khoản!');
		}

		return redirect()->route('user.login')->with('status', 'Tài khoản đã kích hoạt thành công. Vui lòng đăng nhập!');
	}

	public function login()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Đăng nhập', 'user.login');

		return view('frontend.pages.login');
	}

	public function profile()
	{
		//if (Auth::check()) {
		//	return redirect()->route('home');
		//}

		$user = Auth::user();

		$this->setMetadata('Thông tin tài khoản', 'user.profile');

		return view('frontend.pages.profile', compact('user'));
	}

	public function updateProfile(PageRequest $request)
	{
		//if (Auth::check()) {
		//	abort('403');
		//}

		$user = Auth::user();
		DB::transaction(function () use ($user, $request) {
			$user->last_name = strip_tags($request->input('User.last_name', ''));
			$user->first_name = strip_tags($request->input('User.first_name', ''));
			$user->birthday = strip_tags($request->input('User.birthday', ''));
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = strip_tags($request->input('User.gender', ''));
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = strip_tags($request->input('User.job_title', ''));
			$user->mobile_phone = strip_tags($request->input('User.mobile_phone', ''));
			$user->home_phone = strip_tags($request->input('User.home_phone', ''));
			$user->address = strip_tags($request->input('User.address', ''));
			$user->website = strip_tags($request->input('User.website', ''));
			$user->facebook = strip_tags($request->input('User.facebook', ''));
			$user->save();

			//Role::findByKey('Normal')->first()->users()->attach($user);
		});

		return redirect()->back()->with('status', 'Tài khoản đã cập nhật thành công!');
	}

	public function changePassword()
	{
		return redirect()->route('home');
		//if (Auth::check()) {
		//	abort('403');
		//}

		//$this->setMetadata('Thông tin tài khoản', 'user.profile');

		//return view('frontend.pages.profile');
	}

	public function updatePassword(PageRequest $request)
	{
		//if (Auth::check()) {
		//	abort('403');
		//}

		$password = $request->input('User.password', '');
		
		$user = Auth::user();
		$user->password = Hash::make($password);
		$user->save();
		return redirect()->back()->with('status', 'Mật mã của bạn đã cập nhật thành công!');
	}

	public function resetPassword()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}
		$this->setMetadata('Khôi phục mật mã', 'user.resetpassword');

		return view('frontend.pages.resetpasswordemail');
	}

	public function resetPasswordForm(Request $request, $token = null)
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Tạo mật mã mới', 'user.resetpasswordform', ['token' => $token]);

		return view('frontend.pages.resetpasswordform')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

	public function orderHistory()
	{

		$this->setMetadata('Lịch sử mua hàng', 'order.history');

		return view('frontend.pages.orderhistory');
	}

	public function orderDetail($key)
	{

		$this->setMetadata('Chi tiết đơn hàng', 'order.detail');

		return view('frontend.pages.orderdetail');
	}


	public function landingArticle($key)
	{
		$landingArticle = Article::findByKey($key)->first();
		$arr = [$key];
		$this->setMetadata('Landing', 'landingArticle', $arr);
		return view('frontend.pages.landingArticle', compact('landingArticle'));
	}

	public function contact()
	{
		$this->setMetadata('Liên hệ', 'contact');
		return view('frontend.pages.contact');
	}

	public function createContact(PageRequest $request)
	{
		$contact = new Contact;

		$contact->full_name = strip_tags($request->input('Contact.full_name', ''));
		$contact->email = strip_tags($request->input('Contact.email', ''));
		$contact->phone = strip_tags($request->input('Contact.phone', ''));
		$contact->subject =strip_tags( $request->input('Contact.subject', ''));
		$contact->content = strip_tags($request->input('Contact.content', ''));
 
		//save data contact
		$contact->save();

		Notification::send(User::where('type', 1)->get(), new ContactRequest($contact));

		if ($request->ajax()) {
			return response()->json($contact->toArray());
		}

		return redirect(route('contact'))->with('status', 'Nội dung liên hệ của quý khách đã được gửi đến ban quản trị. Chúng tôi sẽ phản hồi quý khách trong thời gian sớm nhất. Xin cảm ơn!');
	}

	private function setMetadata($prefix = '', $route = 'home', $routeParams = [])
	{
		// metadata
		$site_name = Config::getValueByKey('site_name');
		$site_title = Config::getValueByKey('site_title');
		if ($prefix != '') {
			$site_title = $prefix . ' - ' . $site_title;
		}
		$meta_description = Config::getValueByKey('meta_description');
		$meta_keywords = Config::getValueByKey('meta_keywords');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($meta_description);
		SEOMeta::setKeywords([$meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', route($route, $routeParams));
		SEOMeta::addAlternateLanguage('en-us', route($route, $routeParams));

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($meta_description);
		OpenGraph::setUrl(route($route, $routeParams));
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');

		/*$social_banner = BannerCategory::findByKey('banner-social')->first()->banners()->where('published', 1)->orderBy('id', 'desc')->take(5)->get();
		foreach ($social_banner as $key => $banner) {
			OpenGraph::addImage($banner->getFirstAttachment());
		}*/
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata
	}

	private function setMetadataArticle($article, $category)
	{
		// metadata
		$site_title = $article->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($article->meta_description);
		SEOMeta::setKeywords([$article->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addMeta('article:published_time', $article->created_at, 'property');
		SEOMeta::addMeta('article:modified_time', $article->updated_at, 'property');
		SEOMeta::addMeta('article:author', $article->userCreated->facebook, 'property');
		SEOMeta::addMeta('article:publisher', $facebook_page, 'property');

		SEOMeta::addMeta('article:section', 'Games', 'property');
		foreach ($article->tags()->where('published', 1)->get() as $tag) {
			SEOMeta::addMeta('article:tag', $tag->name, 'property');
		}

		SEOMeta::addAlternateLanguage('vi-vn', $article->getLink());
		SEOMeta::addAlternateLanguage('en-us', $article->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($article->meta_description);
		OpenGraph::setUrl($article->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'article');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($article->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata
	}

	public function rss()
	{
		$rssData = [];

		// latest posts
		$articles = Article::where('published', 1)->where('key', '<>', 'footer')->orderBy('id', 'desc')->get();
		foreach ($articles as $article) {
			$data = ['title' => $article->name, 'link' => $article->getLink(), 'description' => $article->summary];
			array_push($rssData, $data);
		}
		//return view('frontend.pages.rss', compact('rssData'));
		return response()->view('frontend.pages.rss', compact('rssData'))->header('Content-Type', 'application/xml');
	}


	public function parentcategory($key)
	{
		$category = ArticleCategory::where('key', $key)->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$childrensCategory = $category->childrens()->where('published', 1)->get();		
		// $newPosts13 = Article::where('published', 1)->orderBy('published_at', 'desc')->take(5)->get();

		$mainArticles = $category->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);
		$breadcrumb = '<li class="active">'.$category->name.'</li>';
		return $this->master('frontend.pages.parentcategory', compact('mainArticles', 'category', 'breadcrumb'));
	}
	public function category($parentcategorykey, $key)
	{
		$category = ArticleCategory::where('key', $key)->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$mainArticles = $category->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);
		$parentCategory = $category->parent()->first();
		/*if($category->menu_display){
			return view('frontend.pages.services', compact('articles', 'category'));
		}*/
		$breadcrumb = '<li><a href="'.$parentCategory->getLink().'">'.$parentCategory->name.'</a></li>
				    <li class="active">'.$category->name.'</li>';
		return $this->master('frontend.pages.category', compact('mainArticles', 'category', 'breadcrumb'));
	}
}
