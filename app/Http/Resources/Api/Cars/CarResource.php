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
            'brand'             => $this->carBrand->name??null,
            'model'             => $this->carModel->name??null,
            'color'             => $this->carColor->name??null,
            'year'              => $this->carYear->year??null,
            'status'            => $this->carStatus->name??null,
            'damage'            => $this->carDamage->name??null,
            'body_type'            => $this->carBodyType->name??null,
            'engine_type'            => $this->carEngineType->name??null,
            'engine_cylinder'            => $this->carEngineCylinder->name??null,
            'transmission_type'            => $this->carTransmissionType->name??null,
            'drive_type'            => $this->carDriveType->name??null,
            'fuel_type'            => $this->carFuelType->name??null,
            'auction'            => $this->carAcution->name??null,
            'warehouse'            => $this->warehouse->name??null,
            'pickup_location'            => $this->pickupLocation->name??null,
            'distance'            => $this->distance,
            'key'            => $this->key,
            'container'            => $this->container,
            'purchasing_date'            => $this->purchasing_date,
            'estimation_arrive_date'            => $this->estimation_arrive_date,
            'warehouse_arrive_date'            => $this->warehouse_arrive_date,
            'company_arrive_date'            => $this->company_arrive_date,
            'port_arrive_date'            => $this->port_arrive_date,
            'shipping_date'            => $this->shipping_date,
            'towing_date'            => $this->towing_date,
            'notes'            => $this->notes,
            'level'             => $this->carStatus->category()->level??'',
            'image'            => $this->image,
          ];
    }
}
