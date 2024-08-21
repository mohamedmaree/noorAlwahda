<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class CreateSubCustomerRequest extends BaseApiRequest {
  
  public function __construct(Request $request) {
    $request['phone']        = fixPhone($request['phone']);
    $request['country_code'] = fixPhone($request['country_code']);
  }

  public function rules() {
    return [
      'name'         => 'required|max:250',
      'country_code' => 'required|numeric|digits_between:2,5',
      'phone'        => 'required|numeric|digits_between:8,10|unique:users,phone,NULL,id,deleted_at,NULL',
      'address'      => 'nullable',
      'password'     => 'required|min:6',
      'country_id'   => 'nullable|exists:countries,id',
    ];
  }

}
