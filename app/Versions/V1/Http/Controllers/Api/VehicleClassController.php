<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\VehicleClass;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\VehicleClassCollection;
use App\Versions\V1\Http\Resources\VehicleClassResource;
use App\Versions\V1\Repositories\VehicleClassRepository;
use Illuminate\Http\Request;

class VehicleClassController extends Controller
{
    public function __construct(
        private VehicleClassRepository $repository
    ) {
    }

    public function index(Request $request): VehicleClassCollection
    {
        return new VehicleClassCollection(
            $this->repository->certainWithOffers(VehicleClass::PER_GROUP)
        );
    }
}
