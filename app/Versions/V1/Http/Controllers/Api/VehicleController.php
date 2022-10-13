<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(
        public VehicleRepository $repository,
    ) {
    }

    public function index(Request $request)
    {
        return new VehicleClassCollection($this->repository->groupedByClass(5));
    }
}
