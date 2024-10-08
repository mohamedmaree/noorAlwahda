<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\CountryResource;

class UsersResource extends JsonResource {


  public function toArray($request) {
    return [
      'id'                  => $this->id,
      'customer_num'        => $this->customer_num,
      'name'                => $this->name,
      'email'               => $this->email,
      'country_code'        => $this->country_code,
      'phone'               => $this->phone,
      'full_phone'          => $this->full_phone,
      'address'             => $this->address,
      'image'               => $this->image,
      'assigned_cars'       => $this->cars->count(),
      'is_blocked'          => $this->is_blocked,
      'block_reason'        => $this->block_reason,
      'is_have_subseries'   => $this->childes->count() > 0 ? true : false,
      'is_main_user'        => $this->parent_id ? false : true,
      'country'             => new CountryResource($this->country),
      'currency_code'       => $this->currency_code,
      'vip'                 => $this->vip,
    ];
  }
}
