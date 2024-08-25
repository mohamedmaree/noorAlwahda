<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Settings\CountryResource;

class UserResource extends JsonResource {
  private $token               = '';

  public function setToken($value) {
    $this->token = $value;
    return $this;
  }

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
      'lang'                => $this->lang,
      'is_notify'           => $this->is_notify,
      'vip'                 => $this->vip,
      'token'               => $this->token,
      'is_have_subseries'   => $this->childes->count() > 0 ? true : false,
      'is_main_user'        => $this->parent_id ? false : true,
      'country'             => new CountryResource($this->country),
      'currency_code'       => $this->currency_code,
    ];
  }
}
