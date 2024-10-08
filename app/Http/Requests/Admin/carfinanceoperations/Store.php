<?php

namespace App\Http\Requests\Admin\carfinanceoperations;

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
            'car_id'                  => 'required|exists:cars,id',
            'price_type_id'           => 'required|array',
            'amount'                  => 'required|array',
            'image'                   => 'nullable',
        ];
    }
}
