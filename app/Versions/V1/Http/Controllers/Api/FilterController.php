<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Repositories\BrandModelRepository;
use App\Versions\V1\Repositories\BrandRepository;
use App\Versions\V1\Repositories\ColorRepository;
use App\Versions\V1\Repositories\VehicleClassRepository;

class FilterController extends Controller
{
    public function __construct(
        public BrandRepository $brandRepository,
        public ColorRepository $colorRepository,
        public BrandModelRepository $brandModelRepository,
        public VehicleClassRepository $vehicleClassRepository,
    ) {
    }

    /**
     * the key names from the returned array correspond 
     * to the filter names from App\Filters\Offer\
     * 
     * @return array
     */
    public function getFilterValues(): array
    {
        $brands = $this->brandRepository->getAllToFilter();
        $colors = $this->colorRepository->getAllToFilter();
        $brandModels = $this->brandModelRepository->getAllToFilter();
        $classes = $this->vehicleClassRepository->getAllToFilter();

        return compact('brandModels', 'brands', 'classes', 'colors');
    }
}
