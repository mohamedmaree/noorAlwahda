<?php

namespace App\Http\Resources\Api\Cars;

use App\Http\Resources\Api\Cars\ShippngPriceListResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShippingListsCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => ShippngPriceListResource::collection($this->collection),
        ];

    }
}
