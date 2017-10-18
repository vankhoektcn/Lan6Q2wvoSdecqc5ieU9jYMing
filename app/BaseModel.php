<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	public function scopeFindByKey($query, $key)
	{
		return $query->where('key', $key);
	}

	public function userCreated()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function userUpdated()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function attachments()
	{
		return $this->morphMany('App\Attachment', 'attachmentable');
	}

	// required model has relation attachments
	public function getFirstAttachment($template = 'custom', $width = null, $height = null, $fit = null)
	{
		$attachment = $this->attachments()->where('published', 1)->orderBy('id')->first();
		if (isset($attachment) && !is_null($attachment)) {
			return $attachment->getLink($template, $width, $height, $fit);
		}
		return '';
	}

	public function hasAttachments()
	{
		$attachment = $this->attachments()->where('published', 1)->orderBy('id')->first();
		// if(isset($attachment)) dd($attachment);
		return (isset($attachment) && !is_null($attachment));
	}
}
