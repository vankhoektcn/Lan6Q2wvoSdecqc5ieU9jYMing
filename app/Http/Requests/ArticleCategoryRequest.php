<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'ArticleCategory.priority'	=> 'integer|min:0',
			'ArticleCategory.published' => 'boolean',
			'ArticleCategory.ArticleCategoryTranslation.*.name' => 'required|max:250',
		];
	}
}
