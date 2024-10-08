<?php

namespace App\Http\Resources\Api\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'key'  => $this->key,
            'flag' => $this->flag,
            'currency_code' => $this->currency_code,
            'currency'      => $this->currency,
        ];
    }
}
