<?php

namespace App\Http\Requests\Admin\carstatuses;

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
            'num_days' => 'required',
            'sort'     => 'required',
            'fields'   => 'nullable|array',
        ];
    }
}
