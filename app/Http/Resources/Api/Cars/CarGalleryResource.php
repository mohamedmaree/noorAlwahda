<?php

namespace App\Http\Resources\Api\Cars;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Cars\CarGalleryImagesResource;

class CarGalleryResource extends JsonResource
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
            'car_status'        => $this->carStatus->name??'',
            'images'            => CarGalleryImagesResource::collection($this->images)
          ];
    }
}
