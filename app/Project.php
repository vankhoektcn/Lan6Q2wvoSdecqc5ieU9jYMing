<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Config;
use DateTime;

class Project extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'price_description', 'content', 'meta_description', 'meta_keywords'];
	protected $dates = ['deleted_at'];

	public function projectCategories()
	{
		return $this->belongsToMany('App\ProjectCategory');
	}

	public function firstProjectCategories()
	{
		return $this->belongsToMany('App\ProjectCategory')->first();
	}

	public function projectType()
	{
		return $this->belongsTo('App\ProjectType');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function province()
    {
        return $this->belongsTo('App\Province');
    }
	public function district()
    {
        return $this->belongsTo('App\District');
    }    
    public function ward()
    {
        return $this->belongsTo('App\Ward');
    }    
    public function street()
    {
        return $this->belongsTo('App\Street');
    }
    
	public function agents()
	{
		return $this->belongsToMany('App\Agent');
	}	
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }

	public function nextProject()
	{
		return Project::where('id', '>', $this->id)->where('published', 1)->orderBy('id', 'desc')->first();
	}

	public function previousProject()
	{
		return Project::where('id', '<', $this->id)->where('published', 1)->orderBy('id', 'desc')->first();
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->get();
	}
	public function getFirstImage()
    {
        $firstAttachment = $this->attachments()->where('published', 1)->first();
        $thumnail = "/uploads/notfound.jpg" ;
        if(isset($firstAttachment))
            $thumnail = $firstAttachment->path;
        return $thumnail;
    }

	public function getLink()
	{
		$projectType = $this->projectType;
		if ($projectType) {
			return route('project', ['categorykey' => $projectType->key, 'key' => $this->key]);
		}
		return '';
	}
	public function addressFull()
    {
        $address = $this->address;
        if(isset($this->street->id))
            $address .= ', '. $this->street->name. (isset($this->ward->id) ?', '. $this->ward->name : ''). ', '. $this->district->name . ', ' . $this->province->name;
        else if(isset($this->ward->id))
            $address .= ', '. $this->ward->name. ', '. $this->district->name . ', ' . $this->province->name;
        else if(isset($this->district->id))
            $address .= ', '. $this->district->name . ', ' . $this->province->name;

        return $address;
    }
}
