<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
			'email' => 'nullable|string',
			'password' => 'nullable|string',
			'profile_img_url' => 'nullable|string',
			'genre' => 'nullable|string',
			'adresse' => 'nullable|string',
			'numero_telephone' => 'nullable|string',
			'numero_whatsapp' => 'nullable|string',
			'numero_telegram' => 'nullable|string',
			'company_name' => 'nullable|string',
			'company_logo_url' => 'nullable|string',
			'type' => 'nullable|string',
			'api_token' => 'nullable|string',
			'is_active' => 'nullable|boolean',
			'is_company' => 'nullable|boolean',

        ];
    }
}
