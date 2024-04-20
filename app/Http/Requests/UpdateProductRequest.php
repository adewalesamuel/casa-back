<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
			'slug' => 'nullable|string',
			'description' => 'nullable|string',
			'prix' => 'nullable|integer',
			'type_paiement' => 'nullable|string',
			'type' => 'nullable|string',
			'display_img_url_list' => 'nullable|json',
			'images_url_list' => 'nullable|json',
			'category_id' => 'nullable|integer|exists:categories,id',
			'municipality_id' => 'nullable|integer|exists:municipalities,id',
			'user_id' => 'nullable|integer|exists:users,id',

        ];
    }
}
