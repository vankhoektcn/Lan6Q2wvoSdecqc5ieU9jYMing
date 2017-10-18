<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];
	protected $table = "agents";
	protected $fillable = ['name', 'priority', 'active', 'created_by', 'updated_by'];
	public static $rules = [
		'thumnail' => 'required',
		'priority' => 'integer',
		'active' => 'boolean'
	];
	protected $dates = ['deleted_at'];


	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}
	
	public function attachments()
	{
		return $this->hasMany('App\Attachment', 'entry_id')->where('table_name', '=', 'agents');
	}
}
