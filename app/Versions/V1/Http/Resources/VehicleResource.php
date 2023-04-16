<?php

namespace App\Versions\V1\Http\Resources;

use App\Versions\V1\Http\Resources\BrandModelResource;
use App\Versions\V1\Http\Resources\BrandResource;
use App\Versions\V1\Http\Resources\Collections\VehicleImageCollection;
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
        $brand = new BrandResource($this->brand);
        $model = new BrandModelResource($this->brandModel);
        $color = new ColorResource($this->color);
        $info  = new VehicleInfoResource($this->whenLoaded('info'));
        $class = new VehicleClassResource($this->whenLoaded('class'));
        $images = new VehicleImageCollection($this->whenLoaded('images'));

        $relations = compact('brand', 'model', 'color', 'info', 'class', 'images');

        return [
            'id' => $this->id,
            'mileage' => $this->mileage,
            'year' => $this->year,
            ...$relations,
        ];
    }
}
