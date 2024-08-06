<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class StoreComplaintRequest extends BaseApiRequest {

  public function rules() {
    return [
      'user_name' => 'required|max:50',
      'phone'     => 'nullable|max:20',
      'email'     => 'nullable|max:20',
      'complaint' => 'required|max:500',
    ];
  }
}
