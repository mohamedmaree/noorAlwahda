<?php

namespace App\Models;

class CarFinance extends BaseModel
{
    const IMAGEPATH = 'carfinances' ; 

    protected $fillable = ['car_id','price_type_id' ,'required_amount','paid_amount'];

    protected $casts = [
        'required_amount'   => 'decimal:2',
        'paid_amount'       => 'decimal:2',
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
