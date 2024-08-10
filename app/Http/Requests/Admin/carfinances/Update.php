<?php

namespace App\Http\Requests\Admin\carfinances;

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
            'car_id'                  => 'required|exists:cars,id',
            'price_type_id'           => 'required|exists:price_types,id',
            'required_amount'         => 'required',
        ];
    }
}
