<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvinceTranslation extends BaseModel
{
    protected $table = "province_translations";
	protected $fillable = ['province_id', 'locale', 'name'];
	public $timestamps = false;
	public static $rules = [
		'name' => 'required|max:250'
	];

	public function province()
	{
		return $this->belongsTo('App\Province');
	}
}
