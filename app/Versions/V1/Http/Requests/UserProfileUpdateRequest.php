<?php

namespace App\Versions\V1\Http\Requests;

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
            'photo'    => ['image'],
            'passport' => ['file', 'mimes:pdf'],
            'license'  => ['file', 'mimes:pdf'],
            'user_id'  => ['required'],
        ];
    }
}
