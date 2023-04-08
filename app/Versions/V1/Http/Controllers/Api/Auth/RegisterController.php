<?php

namespace App\Versions\V1\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Versions\V1\DTO\AdminDto;
use App\Versions\V1\DTO\UserDto;
use App\Versions\V1\DTO\UserProfileDto;
use App\Versions\V1\Http\Requests\AdminRegisterRequest;
use App\Versions\V1\Http\Requests\UserRegisterRequest;
use App\Versions\V1\Services\UserProfileService;
use App\Versions\V1\Services\UserService;
use Illuminate\Support\Facades\DB;

class RegisterController
{
    public function __construct(
        private UserService $service,
        private UserProfileService $profileService,
    ) {
    }

    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        $user = $this->service->store(UserDto::fromRequest($request->input('user')));
        $profile = $this->prepareUserProfileData($request, $user->getUser());

        $this->profileService->store(new UserProfileDto($profile));
        DB::commit();

        $token = $user->createToken()->plainTextToken;
        $user = $user->getUser();

        return compact('user', 'token');
    }

    public function adminRegister(AdminRegisterRequest $request)
    {
        $user = $this->service->store(UserDto::fromRequest($request));
        $token = $user->createToken()->plainTextToken;

        $user = $user->getUser();

        // some new admin policies or else...
        return compact('user', 'token');
    }

    private function prepareUserProfileData(UserRegisterRequest $request, User $user): array
    {
        $user_id = $user->id;
        $profile = $request->all()['profile'];

        $profile['user_id'] = $user_id;

        return $profile;
    }
}
