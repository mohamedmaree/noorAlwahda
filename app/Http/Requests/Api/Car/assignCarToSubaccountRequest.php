<?php

namespace App\Http\Requests\Api\Car;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class assignCarToSubaccountRequest extends BaseApiRequest {
  


  public function rules() {
    return [
      'user_id'  => 'required|exists:users,id',
      'car_id'   => 'required|exists:cars,id',
    ];
  }

}
