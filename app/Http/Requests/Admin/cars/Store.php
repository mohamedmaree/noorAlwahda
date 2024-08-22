<?php

namespace App\Http\Requests\Admin\cars;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id'          => 'nullable|exists:users,id',
            'lot'              => 'required',
            'vin'              => 'required',
            'car_brand_id'             => 'required|exists:car_brands,id',
            'car_model_id'             => 'required|exists:car_models,id',
            'car_year_id'              => 'required|exists:car_years,id',
            'car_color_id'             => 'required|exists:car_colors,id',
            'car_status_id'            => 'nullable|exists:car_statuses,id',
            'car_damage_type_id'       => 'required|exists:damage_types,id',
            'car_body_type_id'         => 'required|exists:body_types,id',
            'car_engine_type_id'         => 'required|exists:engine_types,id',
            'car_engine_cylinder_id'         => 'required|exists:engine_cylinders,id',
            'car_transmission_type_id'         => 'required|exists:transmission_types,id',
            'car_drive_type_id'         => 'required|exists:drive_types,id',
            'car_fuel_type_id'         => 'required|exists:fuel_types,id',
            'auction_id'         => 'required|exists:auctions,id',
            'distance'         => 'required',
            'key'         => 'required',
            'from_country_id'         => 'required|exists:countries,id',
            'region_id'         => 'required|exists:regions,id',
            'to_country_id'         => 'nullable|exists:countries,id',
            'warehouse_id'         => 'nullable|exists:warehouses,id',
            'pickup_location_id'         => 'nullable|exists:branches,id',
            'container'         => 'nullable',
            'purchasing_date'         => 'nullable',
            'estimation_arrive_date'         => 'nullable',
            'warehouse_arrive_date'         => 'nullable',
            'company_arrive_date'         => 'nullable',
            'port_arrive_date'         => 'nullable',
            'shipping_date'         => 'nullable',
            'towing_date'         => 'nullable',
            'notes'         => 'nullable',

            'image'               => 'required',
        ];
    }
}
