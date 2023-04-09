<?php

namespace App\Versions\V1\Http\Requests;

use App\Versions\V1\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            'birthday' => ['date'],
            'phone'    => [],
            'photo'    => ['image', 'max:' . UserService::IMAGE_MAX_SIZE_KB],
            'passport' => ['image', 'max:' . UserService::IMAGE_MAX_SIZE_KB],
            'license'  => ['image', 'max:' . UserService::IMAGE_MAX_SIZE_KB],
            'user_id'  => ['required'],
        ];
    }
}
