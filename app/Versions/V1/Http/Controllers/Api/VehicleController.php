<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleCollection;
use App\Versions\V1\Http\Resources\VehicleClassResource;
use App\Versions\V1\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(
        public VehicleRepository $repository
    ) {
    }

    public function index(Request $request)
    {
        $groupedVehicles = new VehicleClassCollection($this->repository->groupedByClass(5));

        return compact('groupedVehicles');
    }

    public function catalog(Request $request): VehicleCollection
    {
        $this->repository->vehicle->filterBy($request->all());

        return new VehicleCollection($this->repository->paginate());
    }
}
