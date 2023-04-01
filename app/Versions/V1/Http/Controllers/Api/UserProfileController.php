<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\User;
use App\Versions\V1\DTO\UserProfileDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\UserProfileStoreRequest;
use App\Versions\V1\Http\Resources\UserProfileResource;
use App\Versions\V1\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    public function __construct(
        public UserProfileService $service
    ) {
    }

    public function show(Request $request, User $user): UserProfileResource
    {
        return new UserProfileResource($user->profile);
    }

    public function store(UserProfileStoreRequest $request, User $user)
    {
        $this->service->store(UserProfileDto::fromRequest($request));

        return response('', Response::HTTP_OK);
    }
}
