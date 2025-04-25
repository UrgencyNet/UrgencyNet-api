<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'wallet_address' => 'required|string|max:255|unique:users',
            'encrypted_private_key' => 'required|string',
            'emergency_contact' => 'sometimes|string|max:255',
            'blood_type' => 'sometimes|string|max:10',
            'medical_info' => 'sometimes|string|max:1000',
            'location' => 'sometimes|array',
            'location.lat' => 'required_with:location|numeric',
            'location.lng' => 'required_with:location|numeric',
        ];
    }
}
