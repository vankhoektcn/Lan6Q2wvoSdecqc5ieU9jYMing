<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	protected $table = "provinces";
	protected $fillable = ['key', 'priority', 'is_publish', 'created_by', 'updated_by'];
	public static $rules = [
		'priority' => 'integer',
		'is_publish' => 'boolean'
	];

	public $translatedAttributes = ['name'];
	protected $dates = ['deleted_at'];

	public function translations()
	{
		return $this->hasMany('App\ProvinceTranslation');
	}

	public function districts()
	{
		return $this->hasMany('App\District');
	}

	public function products()
	{
		return $this->hasMany('App\Product');
	}
}
