<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
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
			'ProductColor.priority'  => 'integer|min:0',
			'ProductColor.published' => 'boolean',
			'ProductColor.ProductColorTranslation.*.name' => 'required|max:250',
		];
	}
}
