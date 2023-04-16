<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Requests\VehicleStoreRequest;
use App\Models\Vehicle;
use App\Versions\V1\DTO\VehicleDto;
use App\Versions\V1\DTO\VehicleInfoDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleCollection;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Repositories\VehicleClassRepository;
use App\Versions\V1\Repositories\VehicleRepository;
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
        return new VehicleCollection($this->repository->paginate());
    }

    public function show(Request $request, int $id): VehicleResource
    {
        return new VehicleResource($this->repository->find($id));
    }

    public function store(VehicleStoreRequest $request): Response
    {
        DB::transaction(function () use ($request) {
            $vehicle = $this->service->store(VehicleDto::fromRequest($request));

            /** @var VehicleInfoService $infoService */
            $infoService = app(VehicleInfoService::class, compact('vehicle'));

            $infoService->store(VehicleInfoDto::fromRequest($request));
        });

        return response();
    }

    public function destroy(Request $request, Vehicle $vehicle): Response
    {
        /** @var VehicleService $service */
        $service = app(VehicleService::class, compact('vehicle'));

        $service->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
