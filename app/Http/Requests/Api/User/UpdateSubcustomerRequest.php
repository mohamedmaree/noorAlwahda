<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdateSubcustomerRequest extends BaseApiRequest {
  
  public function __construct(Request $request) {
    if($request['phone']){
      $request['phone']        = fixPhone($request['phone']);
    }
    if($request['country_code']){
      $request['country_code'] = fixPhone($request['country_code']);
    }

  }

  public function rules() {
    return [
      'user_id'      => 'required|exists:users,id',
      'name'         => 'sometimes|required|max:250',
      'country_code' => 'sometimes|required|numeric|digits_between:2,5',
      'phone'        => 'sometimes|required|numeric|digits_between:8,10|unique:users,phone,'.request()->user_id.',id,deleted_at,NULL',
      'address'      => 'sometimes|nullable',
    ];
  }

}
