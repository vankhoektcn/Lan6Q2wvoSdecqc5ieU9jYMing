<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DateTime;
use Carbon\Carbon;
use App\Common;
use App\Language;
use App\Attachment;
use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.articles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Article::class);
		return redirect()->route('articles.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ArticleRequest $request)
	{
		$this->authorize('create', Article::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$article = new Article;
		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $article) {
			$user = Auth::user();

			// insert Article
			$article->key = Common::createKeyURL($request->input('Article.ArticleTranslation.'.$languageDefault->code.'.name'));
			$article->priority = $request->input('Article.priority', 0);
			$article->published = $user->hasRoles('Administrator') ? 1: 0;// $request->input('Article.published', 0);
			if($article->published){
				$article->published_by = $user->id;
				$article->published_at = Carbon::now();	
			}
			$article->created_by = $user->id;
			$article->save();

			// sync articleCategories
			$categories =  $request->input('Article.articleCategories', []);
			$categories = array_diff($categories, array('0'));
			if (count($categories) > 0) {
				$article->articleCategories()->attach($categories);
			}

			// sync articleTypes
			$articleTypes =  $request->input('Article.articleTypes', []);
			if (count($articleTypes) > 0) {
				$article->articleTypes()->attach($articleTypes);
			}

			// sync tags
			$tags =  $request->input('Article.tags', []);
			if (count($tags) > 0) {
				$article->tags()->attach($tags);
			}

			// sync related articles
			$relatedArticles =  $request->input('Article.relatedArticles', []);
			if (count($relatedArticles) > 0) {
				$article->relatedArticles()->attach($relatedArticles);
			}

			// save attachments
			if ($request->input('Article.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Article.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => 0,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$article->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Article.ArticleTranslation') as $locale => $value) {
				$article->translateOrNew($locale)->name = $request->input('Article.ArticleTranslation.' .$locale. '.name');
				$article->translateOrNew($locale)->summary = $request->input('Article.ArticleTranslation.' .$locale. '.summary');
				$article->translateOrNew($locale)->content = $request->input('Article.ArticleTranslation.' .$locale. '.content');
				$article->translateOrNew($locale)->meta_description = $request->input('Article.ArticleTranslation.' .$locale. '.meta_description');
				$article->translateOrNew($locale)->meta_keywords = $request->input('Article.ArticleTranslation.' .$locale. '.meta_keywords');
			}

			$article->save();

		});

		$article->load('attachments', 'articleCategories', 'articleTypes', 'tags', 'userCreated');

		if ($request->ajax()) {
			return response()->json($article->toArray());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$article = Article::findOrFail($id);
		$this->authorize('view', $article);
		$article->load('translations', 'articleCategories', 'articleTypes', 'tags', 'attachments', 'userCreated', 'userUpdated', 'relatedArticles');
		return response()->json($article->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$article = Article::findOrFail($id);
		$this->authorize('update', $article);
		return redirect()->route('articles.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ArticleRequest $request, $id)
	{
		$article = Article::findOrFail($id);
		$this->authorize('update', $article);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $article, $languageDefault) {
			$user = Auth::user();

			if (!$article->not_delete) {
				$article->key = Common::createKeyURL($request->input('Article.ArticleTranslation.'.$languageDefault->code.'.name'));
			}
			$article->priority = $request->input('Article.priority', 0);
			$article->published = $user->hasRoles('Administrator') ? 1: 0;// $request->input('Article.published', 0);
			if($article->published){
				$article->published_by = $user->id;
				$article->published_at = Carbon::now();	
			}
			$article->updated_by = $user->id;
			$article->save();

			// sync articleCategories
			$article->articleCategories()->detach();
			$categories =  $request->input('Article.articleCategories', []);
			$categories = array_diff($categories, array('0'));
			if (count($categories) > 0) {
				$article->articleCategories()->attach($categories);
			}

			// sync articleTypes
			$article->articleTypes()->detach();
			$articleTypes =  $request->input('Article.articleTypes', []);
			if (count($articleTypes) > 0) {
				$article->articleTypes()->attach($articleTypes);
			}

			// sync tags
			$article->tags()->detach();
			$tags =  $request->input('Article.tags', []);
			if (count($tags) > 0) {
				$article->tags()->attach($tags);
			}

			// sync related articles
			$article->relatedArticles()->detach();
			$relatedArticles =  $request->input('Article.relatedArticles', []);
			if (count($relatedArticles) > 0) {
				$article->relatedArticles()->attach($relatedArticles);
			}

			// save attachments
			// only insert or delete, not update
			if ($request->input('Article.attachments') != "") {
				$currentAttachments = $article->attachments->pluck('id');
				$requestAttachments = explode(',', $request->input('Article.attachments'));
				$attachments = [];
				$keepAttachments = [];
				foreach ($requestAttachments as $key => $value) {
					if (strpos($value, '|') === false) {
						array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => 0,
						'published' => 1
						]));
					}
					else {
						$attachmentId = explode('|', $value)[0];
						array_push($keepAttachments, $attachmentId);
					}
				}
				if (count($attachments) > 0) {
					$article->attachments()->saveMany($attachments);
				}
				// delete attachments
				foreach ($currentAttachments as $key => $value) {
					if (!in_array($value, $keepAttachments)) {
						Attachment::findOrFail($value)->delete();
					}
				}
			}

			// save data languages
			foreach ($request->input('Article.ArticleTranslation') as $locale => $value) {
				$article->translateOrNew($locale)->name = $request->input('Article.ArticleTranslation.' .$locale. '.name');
				$article->translateOrNew($locale)->summary = $request->input('Article.ArticleTranslation.' .$locale. '.summary');
				$article->translateOrNew($locale)->content = $request->input('Article.ArticleTranslation.' .$locale. '.content');
				$article->translateOrNew($locale)->meta_description = $request->input('Article.ArticleTranslation.' .$locale. '.meta_description');
				$article->translateOrNew($locale)->meta_keywords = $request->input('Article.ArticleTranslation.' .$locale. '.meta_keywords');
			}

			$article->save();

		});

		$article->load('attachments', 'articleCategories', 'articleTypes', 'tags', 'userCreated');

		if ($request->ajax()) {
			return response()->json($article->toArray());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$article = Article::findOrFail($id);
		$this->authorize('destroy', $article);

		DB::transaction(function () use ($article) {
			$user = Auth::user();
			$article->deleted_by = $user->id;
			$article->key = $article->key.'-'.microtime(true);
			$article->save();

			// soft delete
			$article->delete();
		});
	}

	public function filter(ArticleRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			$user = Auth::user();

			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$articles = Article::all();
					return response()->json($articles->toArray());
				}

				if ($ids != '') {
					$articles = Article::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$articles = Article::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($articles->toArray());
			}
			elseif ($type == 'filter') {
				$search = $request->input('search', '');
				$fromDate = $request->input('fromdate', '');
				$toDate = $request->input('todate', '');
				$articletype = $request->input('articletype', '');
				$category = $request->input('category', '');
				$createdBy = $request->input('createdby', '');
				$projectid = $request->input('projectid', '');

				$query = Article::with('attachments', 'articleCategories', 'articleTypes', 'tags', 'userCreated');

				if ($articletype != '') {
					$query->whereHas('articleTypes', function ($query) use ($articletype) {
						$query->where('id', $articletype);
					});
				}
				if ($category != '') {
					$query->whereHas('articleCategories', function ($query) use ($category) {
						$query->where('id', $category);
					});
				}

				if ($projectid != '') {
					$query->where('project_id', $projectid);
				}

				if ($createdBy != '') {
					$query->where('created_by', $createdBy);
				}

				if ($fromDate != '') {
					$query->where('created_at', '>=', DateTime::createFromFormat('d/m/Y', $fromDate));
				}

				if ($toDate != '') {
					$query->where('created_at', '<=', DateTime::createFromFormat('d/m/Y', $toDate));
				}

				if ($search != '') {
					$query->whereTranslationLike('name', '%'. $search .'%');
				}
				if(!$user->hasRoles(['Administrator', 'SuperModerator'])){
					$query->where('created_by', '=', $user->id);
				}

				$articles = $query->get();
				return response()->json($articles->toArray());
			}

			$articles = Article::with('attachments', 'articleCategories', 'articleTypes', 'tags', 'userCreated')->orderBy('priority')->get();
			return response()->json($articles->toArray());
		}
	}

	public function active(ArticleRequest $request, $id)
	{
		$article = Article::findOrFail($id);
		$this->authorize('active', $article);

		DB::transaction(function () use ($article, $request) {
			$user = Auth::user();
			$article->published = $request->input('active', 0);
			if($article->published){
				$article->published_by = $user->id;
				$article->published_at = Carbon::now();	
			}
			$article->save();
		});

		return response()->json($article);
	}
}
