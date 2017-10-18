<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Province;

class District extends BaseModel
{
    use \Dimsav\Translatable\Translatable;
	use SoftDeletes;

	protected $table = "districts";
	protected $fillable = ['key', 'priority', 'is_publish', 'created_by', 'updated_by'];
	public static $rules = [
		'priority' => 'integer',
		'is_publish' => 'boolean'
	];

	public $translatedAttributes = ['name'];
	protected $dates = ['deleted_at'];

	public function province()
    {
        return $this->belongsTo('App\Province');
    }
	public function wards()
	{
		return $this->hasMany('App\Ward');
	}
	public function translations()
	{
		return $this->hasMany('App\DistrictTranslation');
	}

	public function tutorRegisters()
	{
		return $this->belongsToMany('App\TutorRegister');
	}
	
	public function products()
	{
		return $this->hasMany('App\Product');
	}

    public function getLink()
    {
        $link = route('project_type_province_district', ['project_type_key' => 'can-ho-chung-cu', 'province_key' => $this->province->key, 'district_key' => $this->key]);
        return $link;
    }
}
