<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'nom' => 'nullable|string',
			'slug' => 'nullable|string|categories',
			'description' => 'nullable|string',
			'icon_img_url' => 'nullable|string',
			'display_img_url' => 'nullable|string',
			'quantite' => 'nullable|integer',
			'category_id' => 'nullable|integer|exists:categories,id',

        ];
    }
}
