<?php

namespace App\Versions\V1\Http\Resources;

use App\Versions\V1\Http\Resources\BrandModelResource;
use App\Versions\V1\Http\Resources\BrandResource;
use App\Versions\V1\Http\Resources\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brand = new BrandResource($this->whenLoaded('brand'));
        $model = new BrandModelResource($this->whenLoaded('brandModel'));
        $color = new ColorResource($this->whenLoaded('color'));
        $info = new VehicleInfoResource($this->whenLoaded('info'));

        $relations = compact('brand', 'model', 'color', 'info');

        return [
            'id' => $this->id,
            'name' => "$brand->name $model->name",
            'mileage' => $this->mileage,
            'year' => $this->year->format('Y'),
            ...$relations,
        ];
    }
}
