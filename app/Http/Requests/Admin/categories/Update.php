<?php

namespace App\Http\Requests\Admin\categories;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name.*'                  => 'required|max:191',
            'car_statuses_ids'        => 'required|array',
            'level'                   => 'required',
            'sort'                    => 'required',
            'image'                   => ['nullable','image'],
        ];
    }
}
