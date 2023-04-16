<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Requests\VehicleStoreRequest;
use App\Models\Vehicle;
use App\Versions\V1\DTO\OfferDto;
use App\Versions\V1\DTO\VehicleDto;
use App\Versions\V1\DTO\VehicleInfoDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleCollection;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Repositories\VehicleClassRepository;
use App\Versions\V1\Repositories\VehicleRepository;
use App\Versions\V1\Services\OfferService;
use App\Versions\V1\Services\VehicleImageService;
use App\Versions\V1\Services\VehicleInfoService;
use App\Versions\V1\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function __construct(
        public VehicleService $service,
        public VehicleRepository $repository,
        public VehicleClassRepository $vehicleClassRepository,
    ) {
    }

    public function index(Request $request)
    {
        $builder = $this->repository->filterBy($request->all());

        return new VehicleCollection($builder->paginate());
    }

    public function show(Request $request, int $id): VehicleResource
    {
        return new VehicleResource($this->repository->find($id));
    }

    public function store(VehicleStoreRequest $request): Response
    {
        DB::transaction(function () use ($request) {
            $vehicleDto = VehicleDto::fromRequest($request);
            $vehicle = $this->service->store($vehicleDto);

            /** @var VehicleInfoService $infoService */
            $infosService = app(VehicleInfoService::class, compact('vehicle'));
            /** @var VehicleImageService $imgeService */
            $imageService = app(VehicleImageService::class, compact('vehicle'));
            /** @var OfferService $offerService */
            $offerService = app(OfferService::class);

            $infosService->store(VehicleInfoDto::fromRequest($request));
            $offerService->store(OfferDto::fromVehicleWithAttrs($vehicle->id, $request->input('offer')));
            $imageService->storeMedia($vehicleDto->images);
        });

        return response('', Response::HTTP_OK);
    }

    public function destroy(Request $request, Vehicle $vehicle): Response
    {
        /** @var VehicleService $service */
        $service = app(VehicleService::class, compact('vehicle'));

        $service->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
