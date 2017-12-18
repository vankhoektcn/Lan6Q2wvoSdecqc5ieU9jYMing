<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('backend/login', '\App\Http\Controllers\Backend\UserController@login')->name('backend.login');
Route::get('backend/password/reset', '\App\Http\Controllers\Backend\UserController@resetPassword')->name('backend.password.reset');
Route::get('backend/password/reset/{token}', '\App\Http\Controllers\Backend\UserController@showResetForm');

Route::group(['namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => ['auth', 'backend.check']], function() {
	// Controllers Within The "App\Http\Controllers\Backend" Namespace

	Route::get('users/profile', 'UserController@profile')->name('users.profile');
	Route::post('users/passwordchange', 'UserController@passwordChange')->name('users.passwordchange');
	Route::post('users/filter', 'UserController@filter')->name('users.filter');
	Route::post('users/toggleactive', 'UserController@toggleActive')->name('users.toggleactive');
	Route::resource('users', 'UserController');

	Route::resource('languages', 'LanguageController');
	Route::resource('uploads', 'UploadController');
	Route::resource('dashboard', 'DashboardController');
	
	Route::post('configs/filter', 'ConfigController@filter')->name('configs.filter');
	Route::post('configs/sitemap', 'ConfigController@createSitemap')->name('configs.createsitemap');
	Route::resource('configs', 'ConfigController');
	
	Route::post('tags/filter', 'TagController@filter')->name('tags.filter');
	Route::resource('tags', 'TagController');

	Route::post('articles/filter', 'ArticleController@filter')->name('articles.filter');
	Route::post('articles/active/{id}', 'ArticleController@active')->name('articles.active');
	Route::resource('articles', 'ArticleController');

	Route::post('articlecategories/filter', 'ArticleCategoryController@filter')->name('articlecategories.filter');
	Route::resource('articlecategories', 'ArticleCategoryController');
	
	Route::post('articletypes/filter', 'ArticleTypeController@filter')->name('articletypes.filter');
	Route::resource('articletypes', 'ArticleTypeController');

	Route::post('products/filter', 'ProductController@filter')->name('products.filter');
	Route::resource('products', 'ProductController');

	Route::post('productcategories/filter', 'ProductCategoryController@filter')->name('productcategories.filter');
	Route::resource('productcategories', 'ProductCategoryController');
	
	Route::post('producttypes/filter', 'ProductTypeController@filter')->name('producttypes.filter');
	Route::resource('producttypes', 'ProductTypeController');

	Route::post('productcolors/filter', 'ProductColorController@filter')->name('productcolors.filter');
	Route::resource('productcolors', 'ProductColorController');

	Route::post('productsizes/filter', 'ProductSizeController@filter')->name('productsizes.filter');
	Route::resource('productsizes', 'ProductSizeController');

	Route::post('producers/filter', 'ProducerController@filter')->name('producers.filter');
	Route::resource('producers', 'ProducerController');

	Route::post('bannercategories/filter', 'BannerCategoryController@filter')->name('bannercategories.filter');
	Route::resource('bannercategories', 'BannerCategoryController');

	Route::post('banners/filter', 'BannerController@filter')->name('banners.filter');
	Route::resource('banners', 'BannerController');

	Route::post('testimonials/filter', 'TestimonialController@filter')->name('testimonials.filter');
	Route::resource('testimonials', 'TestimonialController');

	Route::get('additionalvalues/hiddencontrols.js', 'AdditionalValueController@buildJsHiddenControls')->name('buildJsHiddenControls');
	Route::post('additionalvalues/filter', 'AdditionalValueController@filter')->name('additionalvalues.filter');
	Route::resource('additionalvalues', 'AdditionalValueController');

	Route::post('additionalcategories/filter', 'AdditionalCategoryController@filter')->name('additionalcategories.filter');
	Route::resource('additionalcategories', 'AdditionalCategoryController');

	Route::post('projects/filter', 'ProjectController@filter')->name('projects.filter');
	Route::resource('projects', 'ProjectController');

	Route::post('projectcategories/filter', 'ProjectCategoryController@filter')->name('projectcategories.filter');
	Route::resource('projectcategories', 'ProjectCategoryController');
	
	Route::post('projecttypes/filter', 'ProjectTypeController@filter')->name('projecttypes.filter');
	Route::resource('projecttypes', 'ProjectTypeController');
	
	Route::post('provinces/filter', 'ProvincesController@filter')->name('provinces.filter');
	Route::resource('provinces', 'ProvincesController');
	
	Route::post('districts/filter', 'DistrictController@filter')->name('districts.filter');
	Route::resource('districts', 'DistrictController');
});


//Route::group(['namespace' => 'Frontend', 'middleware' => ['fronend.protectwebsite']], function()
Route::group(['namespace' => 'Frontend'], function()
{
	// for under construction
	Route::get('/underconstruction.html', 'PageController@underConstruction')->name('under.construction');
	Route::post('/underconstruction.html', 'PageController@underConstruction')->name('under.construction.authentication');

	// for multi language site
	Route::get('/locale/{locale}.html', 'PageController@locale')->name('locale');

	Route::get('/', 'PageController@index')->name('home');

	Route::get('/landing/{key}.html', 'PageController@landingArticle')->name('landingArticle');
	Route::get('lien-he.html', 'PageController@contact')->name('contact');
	Route::post('lien-he.html', 'PageController@createContact')->name('contact.create');

	Route::get('gio-hang.html', 'PageController@shoppingCart')->name('shopping.cart');
	Route::get('thong-tin-thanh-toan.html', 'PageController@paymentInfo')->name('payment.info');
	Route::post('thong-tin-thanh-toan.html', 'PageController@purchase')->name('purchase');
	Route::get('mua-hang-thanh-cong.html', 'PageController@purchaseSuccess')->name('purchase.success');
	
	Route::get('dang-ky.html', 'PageController@register')->name('user.register');
	Route::post('dang-ky.html', 'PageController@createUser')->name('user.create');
	Route::get('xac-nhan-dang-ky/{confirmationcode}', 'PageController@createVerify')->name('create.verify');
	Route::get('dang-nhap.html', 'PageController@login')->name('user.login');
	Route::get('thong-tin-thanh-vien.html', 'PageController@profile')->name('user.profile');
	Route::post('thong-tin-thanh-vien.html', 'PageController@updateProfile')->name('user.updateprofile');
	Route::get('thay-doi-mat-ma.html', 'PageController@changePassword')->name('user.changepassword');
	Route::post('thay-doi-mat-ma.html', 'PageController@updatePassword')->name('user.updatepassword');

	Route::get('khoi-phuc-mat-ma.html', 'PageController@resetPassword')->name('user.resetpassword');
	Route::get('tao-mat-mat-moi/{token}', 'PageController@resetPasswordForm')->name('user.resetpasswordform');
	
	Route::get('lich-su-mua-hang.html', 'PageController@orderHistory')->name('order.history');
	Route::get('chi-tiet-don-hang/{key}.html', 'PageController@memberProfile')->name('order.detail');
	
	Route::get('tim-kiem.html', 'PageController@search')->name('search');

	Route::get('thu-vien.html', 'PageController@gallery')->name('gallery');

	// products category
	Route::get('san-pham/{key}.html', 'PageController@products')->name('products');

	// product detail
	Route::get('san-pham/{categorykey}/{key}.html', 'PageController@product')->name('product');

	// all products
	Route::get('san-pham.html', 'PageController@products')->name('allproducts');

	// products producer
	Route::get('nha-san-xuat/{key}.html', 'PageController@producer')->name('producer');

	// projects category
	Route::get('du-an/{key}.html', 'PageController@projects')->name('projects');

	// project detail
	Route::get('du-an/{categorykey}/{key}.html', 'PageController@project')->name('project');

	// rss
	Route::get('rss', 'PageController@rss')->name('rss');
	// latestPosts
	Route::get('tin-moi', 'PageController@latestPosts')->name('latestPosts');
	// types
	//Route::get('type/{key}', 'PageController@articleTypes')->name('articleTypes');
	Route::get('game-moi', 'PageController@articleTypes')->name('articleTypes');
	// tags
	Route::get('tag/{key}', 'PageController@tag')->name('tag');

	// articles category
	//Route::get('{key}', 'PageController@articles')->name('articles');
	Route::get('danh-muc/{key}', 'PageController@parentcategory')->name('parentcategory');
	Route::get('danh-muc/{parentcategorykey}/{key}', 'PageController@category')->name('category');

	// article detail
	Route::get('bai-viet/{categorykey}/{key}.html', 'PageController@article')->name('article');
});
