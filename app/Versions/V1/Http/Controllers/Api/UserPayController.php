<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\User;
use App\Versions\V1\DTO\UserPayDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\UserPayCardStoreRequest;
use App\Versions\V1\Http\Resources\UserPayResource;
use App\Versions\V1\Services\UserPayService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPayController extends Controller
{
    public function __construct(
        public UserPayService $service
    ) {
    }

    public function show(Request $request, User $user): UserPayResource
    {
        return new UserPayResource($user->pay);
    }

    public function store(UserPayCardStoreRequest $request)
    {
        $this->service->store(UserPayDto::fromRequest($request));

        return response('', Response::HTTP_OK);
    }
}
