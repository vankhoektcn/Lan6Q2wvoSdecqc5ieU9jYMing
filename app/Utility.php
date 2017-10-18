<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends BaseModel
{
    use SoftDeletes;

	protected $table = "utilities";
	protected $fillable = ['name', 'priority', 'active', 'created_by', 'updated_by'];
	public static $rules = [
		'priority' => 'integer',
		'active' => 'boolean'
	];
	protected $dates = ['deleted_at'];


	public function products()
	{
		return $this->belongsToMany('App\Product');
	}
}
