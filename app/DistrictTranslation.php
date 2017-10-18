<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictTranslation extends BaseModel
{
    protected $table = "district_translations";
	protected $fillable = ['district_id', 'locale', 'name'];
	public $timestamps = false;
	public static $rules = [
		'name' => 'required|max:250'
	];

	public function district()
	{
		return $this->belongsTo('App\District');
	}
}
