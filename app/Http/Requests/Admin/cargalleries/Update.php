<?php

namespace App\Http\Requests\Admin\cargalleries;

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
            'car_status_id'           => 'required|exists:car_statuses,id',
            'images'                  => 'nullable'
        ];
    }
}
