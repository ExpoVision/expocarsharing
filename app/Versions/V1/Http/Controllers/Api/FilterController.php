<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\VehicleInfo;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\BodyTypeRepository;
use App\Versions\V1\Repositories\BrandModelRepository;
use App\Versions\V1\Repositories\BrandRepository;
use App\Versions\V1\Repositories\ColorRepository;
use App\Versions\V1\Repositories\VehicleClassRepository;
use Illuminate\Http\Response;

class FilterController extends Controller
{
    public function __construct(
        public BrandRepository $brandRepository,
        public ColorRepository $colorRepository,
        public BrandModelRepository $brandModelRepository,
        public VehicleClassRepository $vehicleClassRepository,
        public BodyTypeRepository $bodyTypeRepository,
    ) {
    }

    /**
     * the key names from the returned array correspond
     * to the filter names from App\Filters\Offer\
     *
     * @return array
     */
    public function getFilterValues(): Response
    {
        $brands = $this->brandRepository->getAllToFilter();
        $colors = $this->colorRepository->getAllToFilter();
        $brandModels = $this->brandModelRepository->getAllToFilter();
        $classes = $this->vehicleClassRepository->getAllToFilter();
        $bodyTypes = $this->bodyTypeRepository->getAllToFilter();

        $data = compact('brandModels', 'brands', 'classes', 'colors', 'bodyTypes');

        return response($data);
    }

    public function getFilterConsts(): Response
    {
        $units = VehicleInfo::$units;
        $transmissions = VehicleInfo::$transmissions;

        $data = compact('units', 'transmissions');

        return response($data);
    }
}
