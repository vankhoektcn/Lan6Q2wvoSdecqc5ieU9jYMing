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
use App\District;

class DistrictController extends Controller
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
        //$this->authorize('create', District::class);
        return redirect()->route('Districts.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create', District::class);

        // find language generate key
        $languageDefault = Language::where('is_key_language', 1)->first();
        if (is_null($languageDefault)) {
            $languageDefault = Language::first();
        }

        $district = new District;

        // sure execute success, if not success rollback
        DB::transaction(function () use ($request, $languageDefault, $district) {
            $user = Auth::user();

            // insert District
            $district->key = Common::createKeyURL($request->input('District.DistrictTranslation.'.$languageDefault->code.'.name'));
            $district->parent_id = $request->input('District.parent_id', 0);
            $district->priority = $request->input('District.priority', 0);
            $district->published = $request->input('District.published', 0);
            $district->created_by = $user->id;
            $district->save();

            // save attachments
            if ($request->input('District.attachments') != "") {
                $requestAttachments = explode(',', $request->input('District.attachments'));
                $attachments = [];
                foreach ($requestAttachments as $key => $value) {
                    array_push($attachments, new Attachment([
                        'path' => $value,
                        'priority' => 0,
                        'published' => 1
                        ]));
                }
                if (count($attachments) > 0) {
                    $district->attachments()->saveMany($attachments);
                }
            }

            // save data languages
            foreach ($request->input('District.DistrictTranslation') as $locale => $value) {
                $district->translateOrNew($locale)->name = $request->input('District.DistrictTranslation.' .$locale. '.name');
                $district->translateOrNew($locale)->summary = $request->input('District.DistrictTranslation.' .$locale. '.summary');
                $district->translateOrNew($locale)->meta_description = $request->input('District.DistrictTranslation.' .$locale. '.meta_description');
                $district->translateOrNew($locale)->meta_keywords = $request->input('District.DistrictTranslation.' .$locale. '.meta_keywords');
            }

            $district->save();

        });

        $district->load('attachments');

        if ($request->ajax()) {
            return response()->json($district->toArray());
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
        $district = District::findOrFail($id);
        //$this->authorize('view', $district);
        $district->load('translations', 'attachments', 'userCreated', 'userUpdated');
        return response()->json($district->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::findOrFail($id);
        //$this->authorize('update', $district);
        return redirect()->route('Districts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::findOrFail($id);
        //$this->authorize('update', $district);

        // find language default
        $languageDefault = Language::where('is_key_language', 1)->first();
        if (is_null($languageDefault)) {
            $languageDefault = Language::first();
        }

        // sure execute success, if not success rollback
        DB::transaction(function () use ($request, $district, $languageDefault) {
            $user = Auth::user();

            if (!$district->not_delete) {
                $district->key = Common::createKeyURL($request->input('District.DistrictTranslation.'.$languageDefault->code.'.name'));
            }
            $district->parent_id = $request->input('District.parent_id', 0);
            $district->priority = $request->input('District.priority', 0);
            $district->published = $request->input('District.published', 0);
            $district->updated_by = $user->id;
            $district->save();

            // save attachments
            // only insert or delete, not update
            if ($request->input('District.attachments') != "") {
                $currentAttachments = $district->attachments->pluck('id');
                $requestAttachments = explode(',', $request->input('District.attachments'));
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
                    $district->attachments()->saveMany($attachments);
                }
                // delete attachments
                foreach ($currentAttachments as $key => $value) {
                    if (!in_array($value, $keepAttachments)) {
                        Attachment::findOrFail($value)->delete();
                    }
                }
            }

            // save data languages
            foreach ($request->input('District.DistrictTranslation') as $locale => $value) {
                $district->translateOrNew($locale)->name = $request->input('District.DistrictTranslation.' .$locale. '.name');
                $district->translateOrNew($locale)->summary = $request->input('District.DistrictTranslation.' .$locale. '.summary');
                $district->translateOrNew($locale)->meta_description = $request->input('District.DistrictTranslation.' .$locale. '.meta_description');
                $district->translateOrNew($locale)->meta_keywords = $request->input('District.DistrictTranslation.' .$locale. '.meta_keywords');
            }

            $district->save();

        });

        $district->load('attachments');

        if ($request->ajax()) {
            return response()->json($district->toArray());
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
        $district = District::findOrFail($id);
        //$this->authorize('destroy', $district);

        DB::transaction(function () use ($district) {
            $user = Auth::user();
            $district->deleted_by = $user->id;
            $district->key = $district->key.'-'.microtime(true);
            $district->save();

            // soft delete
            $district->delete();
        });
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->input('type', '');
            if ($type == 'dropdown') {
                $multiple = $request->input('multiple', 'false');
                $ids = $request->input('ids', '');
                $search = $request->input('search', '');

                if ($multiple == 'false') {
                    $districts = District::all();
                    return response()->json($districts->toArray());
                }

                if ($ids != '') {
                    $districts = District::whereIn('id', $ids)->get();
                }
                if ($search != '') {
                    $districts = District::whereTranslationLike('name', '%'. $search .'%')->get();
                }
                
                return response()->json($districts->toArray());
            }

            $districts = District::with('attachments')->orderBy('priority')->get();
            return response()->json($districts->toArray());
        }
    }
}
