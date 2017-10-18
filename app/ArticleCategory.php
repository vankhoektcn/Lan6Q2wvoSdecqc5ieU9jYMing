<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];

	public function articles()
	{
		return $this->belongsToMany('App\Article');
	}

	public function hasArticle()
	{
		$articles = $this->articles()->take(1)->get();
		return count($articles) > 0;
	}

	public function parent()
	{
		return $this->belongsTo('App\ArticleCategory', 'parent_id');
	}

	public function childrens()
	{
		return $this->hasMany('App\ArticleCategory', 'parent_id')->orderBy('priority');
	}

	public function hasChildrens()
	{
		$childrens = $this->childrens()->take(1)->get();
		return count($childrens) > 0;
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->get();
	}

	public function getLink()
	{
		if(!$this->parent_id)
			return route('parentcategory', ['key' => $this->key]);
		else{
			$parentCategory = $this->parent()->first();
			if ($parentCategory) {
				return route('category', ['parentcategorykey' => $parentCategory->key, 'key' => $this->key]);
			} 
			else
				return '';
		}
	}
}
