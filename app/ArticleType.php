<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleType extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function articles()
	{
		return $this->belongsToMany('App\Article');
	}

	public function parent()
	{
		return $this->belongsTo('App\ArticleType', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ArticleType', 'parent_id');
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->get();
	}

	public function getLink()
	{
		return route('articleTypes', ['key' => $this->key]);
	}
}
