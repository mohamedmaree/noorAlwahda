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
            'image'               => 'required',
        ];
    }
}
