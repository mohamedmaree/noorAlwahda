<?php

namespace App\Models;

class CarFinanceOperations extends BaseModel
{
    const IMAGEPATH = 'carfinanceoperations' ; 

    protected $fillable = ['car_id','price_type_id','amount' ,'image'];

    protected $casts = [
        'amount'   => 'decimal:2',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function priceType()
    {
        return $this->belongsTo(PriceTypes::class, 'price_type_id', 'id');
    }

}
