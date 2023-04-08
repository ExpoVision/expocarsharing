<?php

namespace App\Versions\V1\DTO;

use App\Models\User;
use App\Versions\V1\Http\Requests\UserRegisterRequest;

class UserDto extends UserDtoAbstract
{
    /**
     * @param UserRegisterRequest|array $request
     *
     * @return static
     */
    public static function fromRequest($request)
    {
        $requestData = is_array($request) ? $request : $request->all();

        return new self($requestData + [
            'role' => User::ROLE_USER
        ]);
    }

    public function toUpdateArray(): array
    {
        $fields = $this->toArray();
        $withoutEmptyFields = [];

        foreach ($fields as $key => $val) {
            if ($val) {
                $withoutEmptyFields[$key] = $val;
            }
        }

        return $withoutEmptyFields;
    }
}
