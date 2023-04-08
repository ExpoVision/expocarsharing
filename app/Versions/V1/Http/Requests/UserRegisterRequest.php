<?php

namespace App\Versions\V1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.name' => ['required'],
            'user.email' => ['required', 'email', 'unique:users,email'],
            'user.password' => ['required', 'min:4', 'confirmed'],
            'user.password_confirmation' => ['required'],

            'profile.birthday' => ['date'],
            'profile.phone'    => [],
            'profile.photo'    => ['image'],
            'profile.passport' => ['file', 'mimes:pdf'],
            'profile.license'  => ['file', 'mimes:pdf'],
        ];
    }
}
