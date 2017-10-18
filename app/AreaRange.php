<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaRange extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	protected $table = "area_ranges";
	protected $fillable = ['name', 'priority', 'active', 'created_by', 'updated_by'];
	public static $rules = [
		'priority' => 'integer',
		'active' => 'boolean'
	];
	protected $dates = ['deleted_at'];

	
	public function products()
	{
		return $this->hasMany('App\Product');
	}
}
