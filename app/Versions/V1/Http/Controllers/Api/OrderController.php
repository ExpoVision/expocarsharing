<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\Order;
use App\Versions\V1\DTO\OrderDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\Order\OrderCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderConfirmingCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderRentedCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderReservedCollection;
use App\Versions\V1\Http\Resources\Order\OrderConfirmingResource;
use App\Versions\V1\Http\Resources\Order\OrderRentedResource;
use App\Versions\V1\Http\Resources\Order\OrderReservedResource;
use App\Versions\V1\Http\Resources\Order\OrderFinishResource;
use App\Versions\V1\Http\Resources\Order\OrderResource;
use App\Versions\V1\Repositories\OfferRepository;
use App\Versions\V1\Repositories\OrderRepository;
use App\Versions\V1\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        public OrderService $service,
        public OrderRepository $repository,
    ) {
        $this->authorizeResource(Order::class);
    }

    protected function resourceAbilityMap()
    {
        return [
            ...parent::resourceAbilityMap(),
            'confirmPayment' => 'confirmPayment',
            'confirmRent' => 'confirmRent',
            'finish' => 'finish',
            'reserv' => 'reserv',
            'rent' => 'rent',
        ];
    }

    protected function resourceMethodsWithoutModels()
    {
        return [
            ...parent::resourceMethodsWithoutModels(),
            'confirmPayment',
            'confirmRent',
            'reserv',
        ];
    }

    public function index(Request $request): OrderCollection
    {
        $orders = $this->repository->paginate();

        return new OrderCollection($orders);
    }

    public function show(Request $request, Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function reserv(Request $request, Offer $offer)
    {
        /** @var OfferRepository $offer */
        $offer = app(OfferRepository::class, ['offer' => $offer]);
        $order = null;

        DB::transaction(function () use ($request, $offer, &$order) {
            $offer->makeUnavailable();

            $order = $this->service->store(OrderDto::fromRequest($request));
        });

        return new OrderReservedResource($order);
    }

    public function confirmRent(Request $request, Order $order)
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->confirmRent();

        return new OrderConfirmingResource($order);
    }

    public function confirmPayment(Request $request, Order $order)
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->confirmPayment();

        return new OrderConfirmingResource($order);
    }

    public function rent(Request $request, Order $order)
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->rent();

        return new OrderRentedResource($order);
    }

    public function finish(Request $request, Order $order)
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->finish();

        return new OrderFinishResource($order);
    }

    public function reserved(Request $request): OrderReservedCollection
    {
        $orders = app(OrderRepository::class)->getByStatus(Order::STATUS_RESERVED);

        return new OrderReservedCollection($orders);
    }

    public function confirming(Request $request): OrderConfirmingCollection
    {
        $orders = app(OrderRepository::class)->getByStatus(Order::STATUS_CONFIRMING_RENT);

        return new OrderConfirmingCollection($orders);
    }

    public function rented(Request $request): OrderRentedCollection
    {
        $orders = app(OrderRepository::class)->getByStatus(Order::STATUS_RENTED);

        return new OrderRentedCollection($orders);
    }

    public function cancel(Request $request, Order $order): OrderResource
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->cancel();

        return new OrderResource($order);
    }

    public function forceCancel(Request $request, Order $order): OrderResource
    {
        /** @var OrderService $service */
        $service = app(OrderService::class, compact('order'));

        $order = $service->forceCancel();

        return new OrderResource($order);
    }

    public function archival(Request $request): OrderCollection
    {
        $orders = $this->repository->getTrashed();

        return new OrderCollection($orders);
    }
}
