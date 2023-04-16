<?php

namespace App\Versions\V1\Http\Requests;

use App\Models\VehicleInfo;
use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentYear = now()->year;
        $powerReserveUnits = implode(',', array_keys(VehicleInfo::$units));
        $transmissions = implode(',', array_keys(VehicleInfo::$transmissions));

        return [
            'vehicle.brand_id'         => ['required', 'integer', 'exists:brands,id'],
            'vehicle.brand_model_id'   => ['required', 'integer', 'exists:brand_models,id'],
            'vehicle.color_id'         => ['required', 'integer', 'exists:colors,id'],
            'vehicle.vehicle_class_id' => ['required', 'integer', 'exists:vehicle_classes,id'],
            'vehicle.mileage'          => ['required', 'numeric'],
            'vehicle.license_plate'    => ['required'],
            'vehicle.year'             => ['required', 'integer', 'min:1900', "max:$currentYear"],
            'vehicle.images'           => ['required'],
            'vehicle.images.*'         => ['image'],

            'vehicle_info.body_type_id'       => ['required', 'integer', 'exists:body_types,id'],
            'vehicle_info.power_reserve_unit' => ['required', "in:$powerReserveUnits"],
            'vehicle_info.power_reserve'      => ['required', 'integer'],
            'vehicle_info.consumption'        => ['required', 'numeric'],
            'vehicle_info.horsepower'         => ['required', 'integer'],
            'vehicle_info.transmission'       => ['required', "in:$transmissions"],
            'vehicle_info.multimedia'         => ['required', 'boolean'],
            'vehicle_info.seats'              => ['required', 'integer', 'min:0'],

            'offer.per_minute'                => ['required', 'numeric'],
        ];
    }
}
