<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Common;
use App\Language;
use App\Attachment;
use App\BannerCategory;
use App\Http\Requests\BannerCategoryRequest;

class BannerCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.bannercategories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', BannerCategory::class);
		return redirect()->route('bannercategories.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BannerCategoryRequest $request)
	{
		$this->authorize('create', BannerCategory::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$bannerCategory = new BannerCategory;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $bannerCategory) {
			$user = Auth::user();

			// insert BannerCategory
			$bannerCategory->key = Common::createKeyURL($request->input('BannerCategory.BannerCategoryTranslation.'.$languageDefault->code.'.name'));
			$bannerCategory->parent_id = $request->input('BannerCategory.parent_id', 0);
			$bannerCategory->priority = $request->input('BannerCategory.priority', 0);
			$bannerCategory->published = $request->input('BannerCategory.published', 0);
			$bannerCategory->created_by = $user->id;
			$bannerCategory->save();

			// save attachments
			if ($request->input('BannerCategory.attachments') != "") {
				$requestAttachments = explode(',', $request->input('BannerCategory.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => 0,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$bannerCategory->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('BannerCategory.BannerCategoryTranslation') as $locale => $value) {
				$bannerCategory->translateOrNew($locale)->name = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.name');
				$bannerCategory->translateOrNew($locale)->summary = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.summary');
				$bannerCategory->translateOrNew($locale)->meta_description = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.meta_description');
				$bannerCategory->translateOrNew($locale)->meta_keywords = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$bannerCategory->save();

		});

		$bannerCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($bannerCategory->toArray());
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
		$bannerCategory = BannerCategory::findOrFail($id);
		$this->authorize('view', $bannerCategory);
		$bannerCategory->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($bannerCategory->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$bannerCategory = BannerCategory::findOrFail($id);
		$this->authorize('update', $bannerCategory);
		return redirect()->route('bannercategories.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BannerCategoryRequest $request, $id)
	{
		$bannerCategory = BannerCategory::findOrFail($id);
		$this->authorize('update', $bannerCategory);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $bannerCategory, $languageDefault) {
			$user = Auth::user();

			if (!$bannerCategory->not_delete) {
				$bannerCategory->key = Common::createKeyURL($request->input('BannerCategory.BannerCategoryTranslation.'.$languageDefault->code.'.name'));
			}
			$bannerCategory->parent_id = $request->input('BannerCategory.parent_id', 0);
			$bannerCategory->priority = $request->input('BannerCategory.priority', 0);
			$bannerCategory->published = $request->input('BannerCategory.published', 0);
			$bannerCategory->updated_by = $user->id;
			$bannerCategory->save();

			// save attachments
			// only insert or delete, not update
			if ($request->input('BannerCategory.attachments') != "") {
				$currentAttachments = $bannerCategory->attachments->pluck('id');
				$requestAttachments = explode(',', $request->input('BannerCategory.attachments'));
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
					$bannerCategory->attachments()->saveMany($attachments);
				}
				// delete attachments
				foreach ($currentAttachments as $key => $value) {
					if (!in_array($value, $keepAttachments)) {
						Attachment::findOrFail($value)->delete();
					}
				}
			}

			// save data languages
			foreach ($request->input('BannerCategory.BannerCategoryTranslation') as $locale => $value) {
				$bannerCategory->translateOrNew($locale)->name = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.name');
				$bannerCategory->translateOrNew($locale)->summary = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.summary');
				$bannerCategory->translateOrNew($locale)->meta_description = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.meta_description');
				$bannerCategory->translateOrNew($locale)->meta_keywords = $request->input('BannerCategory.BannerCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$bannerCategory->save();

		});

		$bannerCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($bannerCategory->toArray());
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
		$bannerCategory = BannerCategory::findOrFail($id);
		$this->authorize('destroy', $bannerCategory);

		DB::transaction(function () use ($bannerCategory) {
			$user = Auth::user();
			$bannerCategory->deleted_by = $user->id;
			$bannerCategory->key = $bannerCategory->key.'-'.microtime(true);
			$bannerCategory->save();

			// soft delete
			$bannerCategory->delete();
		});
	}

	public function filter(BannerCategoryRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$bannerCategories = BannerCategory::all();
					return response()->json($bannerCategories->toArray());
				}

				if ($ids != '') {
					$bannerCategories = BannerCategory::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$bannerCategories = BannerCategory::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($bannerCategories->toArray());
			}

			$bannerCategories = BannerCategory::with('attachments')->orderBy('priority')->get();
			return response()->json($bannerCategories->toArray());
		}
	}
}
