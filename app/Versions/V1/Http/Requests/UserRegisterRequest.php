<?php

namespace App\Versions\V1\Http\Requests;

use App\Versions\V1\Services\UserService;
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

            'profile.birthday' => ['required', 'date'],
            'profile.phone'    => ['required'],
            'profile.photo'    => ['required', 'image'],
            'profile.passport' => ['required', 'image', 'max:' . UserService::IMAGE_MAX_SIZE_KB],
            'profile.license'  => ['required', 'image', 'max:' . UserService::IMAGE_MAX_SIZE_KB],
        ];
    }
}
