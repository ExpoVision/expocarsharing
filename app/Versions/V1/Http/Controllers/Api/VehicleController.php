<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\FilterRepository;
use App\Versions\V1\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct(
        public VehicleRepository $repository,
        public FilterRepository $filterRepository,
    ) {
    }

    public function index(Request $request)
    {
        $groupedVehicles = new VehicleClassCollection($this->repository->groupedByClass(5));
        $filterFill = $this->filterRepository->getFilterValues();

        return compact('groupedVehicles', 'filterFill');
    }
}
