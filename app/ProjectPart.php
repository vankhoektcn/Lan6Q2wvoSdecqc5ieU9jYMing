<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectPart extends Model
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'summary', 'content', 'meta_description', 'meta_keywords'];

    protected $table = "project_parts";
	protected $fillable = ['project_id', 'key', 'name','class', 'link', 'type', 'fa_icon', 'summary', 'content', 'priority', 'active', 'created_by', 'updated_by'];
	public static $rules = [
        'priority' => 'integer',
        'is_publish' => 'boolean'
    ];
    protected $dates = ['deleted_at'];


	public function project()
	{
		return $this->belongsTo('App\Project');
	}

    public function getLink()
    {
    	if(isset($this->link) && !empty($this->link))
    		return $this->link;
        $project = $this->project;
        $district_key = $project->district->key;
        $link = route('project_part', ['districtkey' => $district_key,'projectkey' => $project->key, 'projectpartid' => $this->id, 'projectpartkey' => $this->key]);
        return $link;
    }
}
