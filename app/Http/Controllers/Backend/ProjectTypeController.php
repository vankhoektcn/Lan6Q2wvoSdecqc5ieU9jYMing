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
use App\ProjectType;
use App\Http\Requests\ProjectTypeRequest;

class ProjectTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.projecttypes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//$this->authorize('create', ProjectType::class);
		return redirect()->route('ProjectTypes.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProjectTypeRequest $request)
	{
		//$this->authorize('create', ProjectType::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$projectType = new ProjectType;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $projectType) {
			$user = Auth::user();

			// insert ProjectType
			$projectType->key = Common::createKeyURL($request->input('ProjectType.ProjectTypeTranslation.'.$languageDefault->code.'.name'));
			$projectType->parent_id = $request->input('ProjectType.parent_id', 0);
			$projectType->priority = $request->input('ProjectType.priority', 0);
			$projectType->published = $request->input('ProjectType.published', 0);
			$projectType->created_by = $user->id;
			$projectType->save();

			// save attachments
			if ($request->input('ProjectType.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProjectType.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => 0,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$projectType->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProjectType.ProjectTypeTranslation') as $locale => $value) {
				$projectType->translateOrNew($locale)->name = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.name');
				$projectType->translateOrNew($locale)->summary = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.summary');
				$projectType->translateOrNew($locale)->meta_description = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.meta_description');
				$projectType->translateOrNew($locale)->meta_keywords = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.meta_keywords');
			}

			$projectType->save();

		});

		$projectType->load('attachments');

		if ($request->ajax()) {
			return response()->json($projectType->toArray());
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
		$projectType = ProjectType::findOrFail($id);
		//$this->authorize('view', $projectType);
		$projectType->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($projectType->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$projectType = ProjectType::findOrFail($id);
		//$this->authorize('update', $projectType);
		return redirect()->route('ProjectTypes.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProjectTypeRequest $request, $id)
	{
		$projectType = ProjectType::findOrFail($id);
		//$this->authorize('update', $projectType);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $projectType, $languageDefault) {
			$user = Auth::user();

			if (!$projectType->not_delete) {
				$projectType->key = Common::createKeyURL($request->input('ProjectType.ProjectTypeTranslation.'.$languageDefault->code.'.name'));
			}
			$projectType->parent_id = $request->input('ProjectType.parent_id', 0);
			$projectType->priority = $request->input('ProjectType.priority', 0);
			$projectType->published = $request->input('ProjectType.published', 0);
			$projectType->updated_by = $user->id;
			$projectType->save();

			// save attachments
			// only insert or delete, not update
			if ($request->input('ProjectType.attachments') != "") {
				$currentAttachments = $projectType->attachments->pluck('id');
				$requestAttachments = explode(',', $request->input('ProjectType.attachments'));
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
					$projectType->attachments()->saveMany($attachments);
				}
				// delete attachments
				foreach ($currentAttachments as $key => $value) {
					if (!in_array($value, $keepAttachments)) {
						Attachment::findOrFail($value)->delete();
					}
				}
			}

			// save data languages
			foreach ($request->input('ProjectType.ProjectTypeTranslation') as $locale => $value) {
				$projectType->translateOrNew($locale)->name = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.name');
				$projectType->translateOrNew($locale)->summary = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.summary');
				$projectType->translateOrNew($locale)->meta_description = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.meta_description');
				$projectType->translateOrNew($locale)->meta_keywords = $request->input('ProjectType.ProjectTypeTranslation.' .$locale. '.meta_keywords');
			}

			$projectType->save();

		});

		$projectType->load('attachments');

		if ($request->ajax()) {
			return response()->json($projectType->toArray());
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
		$projectType = ProjectType::findOrFail($id);
		//$this->authorize('destroy', $projectType);

		DB::transaction(function () use ($projectType) {
			$user = Auth::user();
			$projectType->deleted_by = $user->id;
			$projectType->key = $projectType->key.'-'.microtime(true);
			$projectType->save();

			// soft delete
			$projectType->delete();
		});
	}

	public function filter(ProjectTypeRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$projectTypes = ProjectType::all();
					return response()->json($projectTypes->toArray());
				}

				if ($ids != '') {
					$projectTypes = ProjectType::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$projectTypes = ProjectType::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($projectTypes->toArray());
			}

			$projectTypes = ProjectType::with('attachments')->orderBy('priority')->get();
			return response()->json($projectTypes->toArray());
		}
	}
}
