<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
			'email' => 'required|string|unique:users',
			'password' => 'required|string|unique:users',
			'profile_img_url' => 'required|string',
			'genre' => 'required|string',
			'adresse' => 'required|string',
			'numero_telephone' => 'required|string',
			'numero_whatsapp' => 'required|string',
			'numero_telegram' => 'required|string',
			'company_name' => 'required|string',
			'company_logo_url' => 'required|string',
			'type' => 'required|string',
			'api_token' => 'required|string',
			'is_active' => 'required|boolean',
			'is_company' => 'required|boolean',
			
        ];
    }
}