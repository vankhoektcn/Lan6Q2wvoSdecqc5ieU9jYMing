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
use App\Project;
use App\Article;
use App\ArticleTranslation;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		//dd($user);
		return view('backend.projects.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//$this->authorize('create', Project::class);
		return redirect()->route('projects.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProjectRequest $request)
	{
		//dd($request->input('Project.ProjectTranslation.vi.name'));
		//$this->authorize('create', Project::class);
		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$project = new Project;
		//dd($request->input('Project.ProjectTranslation'));

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $project) {
			$user = Auth::user();
			// insert Project
			$project->key = Common::createKeyURL($request->input('Project.ProjectTranslation.'.$languageDefault->code.'.name'));
			$project->project_type_id = $request->input('Project.project_type_id');
			$project->province_id = $request->input('Project.province_id');
			$project->district_id = $request->input('Project.district_id', null);
			$project->ward_id = $request->input('Project.ward_id', null);
			$project->street_id = $request->input('Project.street_id', null);
			$project->address = $request->input('Project.address', null);
			$project->hotline = $request->input('Project.hotline', null);
			$project->email = $request->input('Project.email');
			$project->show_slide = $request->input('Project.show_slide', true);

			$project->map_latitude = $request->input('Project.map_latitude', null);
			$project->map_longitude = $request->input('Project.map_longitude', null);

			$project->priority = $request->input('Project.priority', 0);
			$project->published = $request->input('Project.published', 0);
			if($project->published){
				$project->published_by = $user->id;
				$project->published_at = Carbon::now();	
			}
			$project->created_by = $user->id;
			$project->updated_by = $user->id;
			$project->save();

			// sync ProjectCategories
			$categories =  $request->input('Project.projectCategories', []);
			if (count($categories) > 0) {
				$project->ProjectCategories()->attach($categories);
			}

			// sync tags
			$tags =  $request->input('Project.tags', []);
			if (count($tags) > 0) {
				$project->tags()->attach($tags);
			}

			// save attachments
			if ($request->input('Project.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Project.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => 0,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$project->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Project.ProjectTranslation') as $locale => $value) {
				$project->translateOrNew($locale)->name = $request->input('Project.ProjectTranslation.' .$locale. '.name');
				$project->translateOrNew($locale)->price_description = $request->input('Project.ProjectTranslation.' .$locale. '.price_description');
				$project->translateOrNew($locale)->summary = $request->input('Project.ProjectTranslation.' .$locale. '.summary');
				$project->translateOrNew($locale)->content = $request->input('Project.ProjectTranslation.' .$locale. '.content');
				$project->translateOrNew($locale)->meta_description = $request->input('Project.ProjectTranslation.' .$locale. '.meta_description');
				$project->translateOrNew($locale)->meta_keywords = $request->input('Project.ProjectTranslation.' .$locale. '.meta_keywords');
			}

			// Create Project Articles
			/*$project_part_name = ['Vị trí','Tiện ích','Mặt bằng'
            ,'Nhà mẫu','Thanh toán'];
			$project_part_type = ['E','E','E'
			,'E','E'];
            $project_part_link = ['project-location','project-utility','project-ground'
            ,'project-form','project-payment'];
			$project_part_fa_icon = ['fa fa-map-marker','fa fa-object-group','fa fa-database'
			,'fa fa-home','fa fa-money'];
            $project_part_summary = ['Mô tả ngắn gọn Vị trí','Mô tả ngắn gọn Tiện ích','Mô tả ngắn gọn Mặt bằng'
            ,'Mô tả ngắn gọn Nhà mẫu','Mô tả ngắn gọn Thanh toán'];
        	$project_part_content = ['Nội dung Vị trí','Nội dung Tiện ích','Nội dung Mặt bằng'
            ,'Nội dung Nhà mẫu','Nội dung Thanh toán'];

            foreach ($project_part_name as $key => $name) {	
				$project_article = Article::create([
        			'project_id' => $project->id,
					'key' => Common::createKeyURL($name.' '.$project->name),
					'priority' => $key,
					'published' => 0,
					'created_by' => $user->id
				]);
				$project_article->translations()->save( new ArticleTranslation ([
					'article_id' => $project_article->id,
					'locale' => 'vi',
					'name' => $name,
					'summary' => $project_part_summary[$key],
					'content' => $project_part_content[$key],
					'meta_description' => $name.' '.$project->name,
					'meta_keywords' => $name.' '.$project->name
				]));
        	}*/

			$project->save();

		});

		$project->load('attachments', 'projectCategories', 'projectType', 'tags');

		if ($request->ajax()) {
			return response()->json($project->toArray());
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
		$project = Project::findOrFail($id);
		//$this->authorize('view', $project);
		$project->load('translations', 'projectCategories', 'projectType', 'tags', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($project->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);
		//$this->authorize('update', $project);
		return redirect()->route('projects.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProjectRequest $request, $id)
	{
		$project = Project::findOrFail($id);
		//$this->authorize('update', $project);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $project, $languageDefault) {
			$user = Auth::user();
			
			$project->key = Common::createKeyURL($request->input('Project.ProjectTranslation.'.$languageDefault->code.'.name'));
			$project->project_type_id = $request->input('Project.project_type_id');
			$project->province_id = $request->input('Project.province_id');
			$project->district_id = $request->input('Project.district_id', null);
			$project->ward_id = $request->input('Project.ward_id', null);
			$project->street_id = $request->input('Project.street_id', null);
			$project->address = $request->input('Project.address', null);
			$project->hotline = $request->input('Project.hotline', null);
			$project->email = $request->input('Project.email');
			$project->show_slide = $request->input('Project.show_slide', true);

			$project->map_latitude = $request->input('Project.map_latitude', null);
			$project->map_longitude = $request->input('Project.map_longitude', null);

			$project->priority = $request->input('Project.priority', 0);
			$project->published = $request->input('Project.published', 0);
			if($project->published){
				$project->published_by = $user->id;
				$project->published_at = Carbon::now();	
			}
			$project->updated_by = $user->id;
			$project->save();

			// sync ProjectCategories
			$project->ProjectCategories()->detach();
			$categories =  $request->input('Project.projectCategories', []);
			if (count($categories) > 0) {
				$project->ProjectCategories()->attach($categories);
			}

			// sync tags
			$project->tags()->detach();
			$tags =  $request->input('Project.tags', []);
			if (count($tags) > 0) {
				$project->tags()->attach($tags);
			}

			// save attachments
			// only insert or delete, not update
			if ($request->input('Project.attachments') != "") {
				$currentAttachments = $project->attachments->pluck('id');
				$requestAttachments = explode(',', $request->input('Project.attachments'));
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
					$project->attachments()->saveMany($attachments);
				}
				// delete attachments
				foreach ($currentAttachments as $key => $value) {
					if (!in_array($value, $keepAttachments)) {
						Attachment::findOrFail($value)->delete();
					}
				}
			}

			// save data languages
			foreach ($request->input('Project.ProjectTranslation') as $locale => $value) {
				$project->translateOrNew($locale)->name = $request->input('Project.ProjectTranslation.' .$locale. '.name');
				$project->translateOrNew($locale)->price_description = $request->input('Project.ProjectTranslation.' .$locale. '.price_description');
				$project->translateOrNew($locale)->summary = $request->input('Project.ProjectTranslation.' .$locale. '.summary');
				$project->translateOrNew($locale)->content = $request->input('Project.ProjectTranslation.' .$locale. '.content');
				$project->translateOrNew($locale)->meta_description = $request->input('Project.ProjectTranslation.' .$locale. '.meta_description');
				$project->translateOrNew($locale)->meta_keywords = $request->input('Project.ProjectTranslation.' .$locale. '.meta_keywords');
			}

			$project->save();

		});

		$project->load('attachments', 'projectCategories', 'projectType', 'tags');

		if ($request->ajax()) {
			return response()->json($project->toArray());
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
		$project = Project::findOrFail($id);
		//$this->authorize('destroy', $project);

		DB::transaction(function () use ($project) {
			$user = Auth::user();
			$project->deleted_by = $user->id;
			$project->key = $project->key.'-'.microtime(true);
			$project->save();

			// soft delete
			$project->delete();
		});
	}

	public function filter(ProjectRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			$user = Auth::user();

			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$projects = Project::all();
					return response()->json($projects->toArray());
				}

				if ($ids != '') {
					$projects = Project::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$projects = Project::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($projects->toArray());
			}
			elseif ($type == 'filter') {
				$search = $request->input('search', '');
				$fromDate = $request->input('fromdate', '');
				$toDate = $request->input('todate', '');
				$type = $request->input('type', '');
				$createdBy = $request->input('createdby', '');
				$category = $request->input('category', '');

				$query = Project::with('attachments', 'projectCategories', 'projectType', 'tags');


				if ($type != '') {
					$query->where('project_type_id', $type);
				}
				if ($category != '') {
					$query->whereHas('projectCategories', function ($query) use ($category) {
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
				/*if($projectTypeId){
					$query->whereExists(function ($queryDb1) use ($projectTypeId) {
							$queryDb1->select(DB::raw(1))
							->from('project_project_category')
							->whereRaw('project_project_category.project_id = projects.id')
							->where('project_project_category.project_category_id', '=',$projectTypeId);
						});
				}*/
				if(!$user->hasRoles(['Administrator', 'SuperModerator'])){
					$query->where('created_by', '=', $user->id);
				}

				$projects = $query->get();
				return response()->json($projects->toArray());
			}

			$projects = Project::with('attachments', 'projectCategories', 'projectType', 'tags')->orderBy('created_at', 'desc')->get();
			return response()->json($projects->toArray());
		}
	}
}
