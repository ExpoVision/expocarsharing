<?php

namespace App\Versions\V1\Repositories;

class FilterRepository
{
    public function __construct(
        public BrandRepository $brandRepository,
        public ColorRepository $colorRepository,
        public BrandModelRepository $brandModelRepository,
        public VehicleClassRepository $vehicleClassRepository,
    ) {
    }

    public function getFilterValues(): array
    {
        $brands = $this->brandRepository->getAllToFilter();
        $colors = $this->colorRepository->getAllToFilter();
        $models = $this->brandModelRepository->getAllToFilter();
        $classes = $this->vehicleClassRepository->getAllToFilter();

        return compact('brands', 'colors', 'models', 'classes');
    }
}
