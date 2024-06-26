<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
			'description' => 'required|string',
			'prix' => 'required|integer',
			'type_paiement' => 'required|string',
			'type' => 'required|string',
			'display_img_url_list' => 'required|array',
			'images_url_list' => 'required|array',
			'category_id' => 'required|integer|exists:categories,id',
			'municipality_id' => 'required|integer|exists:municipalities,id',
			'user_id' => 'nullable|integer|exists:users,id',

        ];
    }
}
