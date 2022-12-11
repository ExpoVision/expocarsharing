<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\VehicleClass;
use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleCollection;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Repositories\VehicleClassRepository;
use App\Versions\V1\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(
        public VehicleRepository $repository,
        public VehicleClassRepository $vehicleClassRepository
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
}
