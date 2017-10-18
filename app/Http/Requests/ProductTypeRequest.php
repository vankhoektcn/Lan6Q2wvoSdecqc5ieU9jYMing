<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
			'ProductTye.priority'  => 'integer|min:0',
			'ProductTye.published' => 'boolean',
			'ProductTye.ProductTyeTranslation.*.name' => 'required|max:250',
		];
	}
}
