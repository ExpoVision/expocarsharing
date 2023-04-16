<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\VehicleClass;
use App\Versions\V1\Http\Resources\Collections\OfferCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Resources\OfferResource;
use App\Versions\V1\Http\Resources\VehicleClassResource;
use App\Versions\V1\Repositories\OfferRepository;
use App\Versions\V1\Repositories\VehicleClassRepository;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(
        public OfferRepository $repository,
        public VehicleClassRepository $classRepository,
    ) {
    }

    public function index(Request $request): OfferCollection
    {
        $builder = $this->repository->getOffer()->filterBy($request->all());

        return new OfferCollection($builder->paginate());
    }

    public function show(Request $request, Offer $offer): OfferResource
    {
        return new OfferResource($offer);
    }

    public function groupedByClass(Request $request): VehicleClassResource
    {
        return new VehicleClassResource(
            $this->classRepository->certainWithOffers(VehicleClass::PER_GROUP)
        );
    }
}
