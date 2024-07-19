<?php

namespace App\Http\Requests\Admin\carmodels;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*'   => 'required',
            'car_brand_id'   => 'required|exists:car_brands,id',
            'image'    => 'nullable|image',
        ];
    }
}
