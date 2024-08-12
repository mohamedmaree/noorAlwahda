<?php

namespace App\Http\Resources\Api\Cars;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarFinanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'price_type'          => $this->priceType->name??'',
            'required_amount'     => $this->required_amount,
            'paid_amount'         => $this->paid_amount,
          ];
    }
}
