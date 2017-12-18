<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Config;
use DateTime;

class Article extends BaseModel
{
	use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'content', 'meta_description', 'meta_keywords'];
	protected $dates = ['deleted_at'];
	//protected $fillable = ['project_id', 'key', 'priority', 'published', 'not_delete', 'created_by', 'published_by'];
	protected $guarded = [];

	public function articleCategories()
	{
		return $this->belongsToMany('App\ArticleCategory');
	}

	public function firstArticleCategories()
	{
		return $this->belongsToMany('App\ArticleCategory')->first();
	}

	public function articleTypes()
	{
		return $this->belongsToMany('App\ArticleType');
	}

	public function project()
	{
		return $this->belongsTo('App\Project');
	}

	public function relatedArticles()
	{
		return $this->belongsToMany('App\Article', 'related_articles', 'article_id', 'related_article_id');
	}

	public function tags()
	{
		return $this->morphToMany('App\Tag', 'taggable');
	}

	public function getVisibleRelatedArticles()
	{
		return $this->relatedArticles()->where('published', 1)->orderBy('id', 'desc')->get();
	}

	public function getVisibleAttachments()
	{
		return $this->attachments()->where('published', 1)->get();
	}

	public function getCreatedAtFormat($format = null)
	{
		if(is_null($format))
			$format = "d/m/Y";
		return date_format($this->created_at, $format);
	}

	public function getLink()
	{
		$firstCategory = $this->articleCategories()->first();
		if ($firstCategory) {
			return route('article', ['categorykey' => $firstCategory->key, 'key' => $this->key]);
		}
		return '';
	}

	public function getJSONLD(){
		return '{
			"@context": "http://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage":{
				"@type":"WebPage",
				"@id":"'. $this->getLink() .'"
			},
			"headline": "'. $this->name .'",
			"image": {
				"@type": "ImageObject",
				"url": "'. $this->getFirstAttachment() .'",
				"height": "1200",
				"width": "630"
			},
			"datePublished": "'. $this->created_at .'",
			"dateModified": "'. $this->updated_at .'",
			"author": {
				"@type": "Person",
				"name": "'. $this->userCreated->getFullName() .'"
			},
			"publisher": {
				"@type": "Organization",
				"name": "'. Config::getValueByKey('site_name') .'",
				"logo": {
					"@type": "ImageObject",
					"url": "'. route('home') .'/frontend/images/logo.png",
					"width": "600",
					"height": "400"
				}
			},
			"description": "'. $this->summary .'"
		}';
	}
}
