<?php

namespace App\Http\Requests\Admin\carattachments;

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
            'car_id'                => 'required|exists:cars,id',
            'name'                  => 'required',
            'image'                 => 'required',

        ];
    }
}
