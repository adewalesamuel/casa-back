<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'nom' => 'required|string',
			'slug' => 'required|string|unique:categories',
			'description' => 'required|string',
			'icon_img_url' => 'required|string',
			'display_img_url' => 'required|string',
			'quantite' => 'required|integer',
			'category_id' => 'required|integer|exists:categories,id',

        ];
    }
}