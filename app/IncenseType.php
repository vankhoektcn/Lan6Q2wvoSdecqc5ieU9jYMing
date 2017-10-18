<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncenseType extends BaseModel
{
    use SoftDeletes;
	use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'summary', 'meta_description', 'meta_keywords'];
}
