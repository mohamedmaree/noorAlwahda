<?php

namespace App\Http\Resources\Api\Cars;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'car_num'           => $this->car_num,
            'lot'               => $this->lot,
            'vin'               => $this->vin,
            'brand'             => $this->carBrand->name??'',
            'model'             => $this->carModel->name??'',
            'color'             => $this->carColor->name??'',
            'year'              => $this->carYear->year??'',
            'status'              => $this->carStatus->name??'',
            'image'             => $this->image,
          ];
    }
}
