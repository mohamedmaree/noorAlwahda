<?php

namespace App\Http\Resources\Api\Cars;

use App\Http\Resources\Api\Cars\CarResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarsCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => CarResource::collection($this->collection),
        ];

    }
}
