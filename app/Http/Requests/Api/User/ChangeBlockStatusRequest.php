<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class ChangeBlockStatusRequest extends BaseApiRequest {
  


  public function rules() {
    return [
      'user_id'      => 'required|exists:users,id',
      'is_blocked'   => 'required|in:0,1',
      'block_reason' => 'nullable',
    ];
  }

}
