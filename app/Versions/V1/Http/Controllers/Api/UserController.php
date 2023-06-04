<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\User;
use App\Versions\V1\DTO\UserDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Requests\UserPasswordUpdateRequest;
use App\Versions\V1\Http\Resources\Collections\UserCollection;
use App\Versions\V1\Http\Resources\Order\OrderResource;
use App\Versions\V1\Http\Resources\Order\OrderResourceFactory;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Repositories\OrderRepository;
use App\Versions\V1\Repositories\UserRepository;
use App\Versions\V1\Services\UserService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        public UserRepository $repository,
        public UserService $service,
        public OrderRepository $orderRepository,
    ) {
    }

    public function index(Request $request)
    {
        return new UserCollection($this->repository->paginate());
    }

    public function updatePassword(UserPasswordUpdateRequest $request, User $user)
    {
        /** @var UserService $service */
        $this->service = app(UserService::class, compact('user'));

        $this->service->updatePassword(UserDto::fromRequest($request));

        return response('', Response::HTTP_OK);
    }

    public function update(Request $request, User $user): UserResource
    {
        /** @var UserService $service */
        $this->service = app(UserService::class, compact('user'));

        $this->service->update(UserDto::fromRequest($request));

        return new UserResource($this->service->getUser());
    }

    public function show(Request $request, User $user): UserResource
    {
        return new UserResource($user);
    }

    public function destroy(Request $request, User $user): Response
    {
        /** @var UserService $service */
        $this->service = app(UserService::class, compact('user'));

        $this->service->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function getCurrentUserOrder(Request $request): ?OrderResource
    {
        if (!auth()->hasUser()) {
            throw new AuthenticationException(__('auth.exception.not_set'));
        }

        $order = $this->orderRepository->getOrderByUser(auth()->user());

        return OrderResourceFactory::create($order->status, $order);
    }

    public function fetchProfile(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function order(Request $request): OrderResource
    {
        $this->repository = app(UserRepository::class, [
            'user' => auth()->user(),
        ]);

        return new OrderResource($this->repository->getOrder());
    }
}
