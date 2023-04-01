<?php

namespace App\Versions\V1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPayCardStoreRequest extends FormRequest
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
            'card_number'    => ['required', 'integer'],
            'expdate_year'   => ['required', 'integer'],
            'expdate_month'  => ['required', 'min:1', 'max:12'],
            'cvv'            => ['required', 'integer'],
            'holder_name'    => ['required', 'string'],
            'holder_surname' => ['required'],
            'user_id'        => ['required', 'exists:users,id'],
        ];
    }
}
