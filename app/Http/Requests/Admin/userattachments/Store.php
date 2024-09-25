<?php

namespace App\Http\Requests\Admin\userattachments;

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
            'user_id'                => 'required|exists:users,id',
            'name'                  => 'required',
            'image'                 => 'required',
        ];
    }
}
