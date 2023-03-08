<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Order;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\OfferRepository;
use App\Versions\V1\Repositories\OrderRepository;
use App\Versions\V1\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function __construct(
        private UserRepository  $userRepository,
        private OrderRepository $orderRepository,
        private OfferRepository $offerRepository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $users  = $this->userRepository->count();
        $offers = $this->offerRepository->count();
        $rented = $this->orderRepository->countByStatus(Order::STATUS_RENTED);

        return response()->json(compact('users', 'offers', 'rented'));
    }
}
