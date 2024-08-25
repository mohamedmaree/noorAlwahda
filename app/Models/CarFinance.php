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

    public function getRequiredAmountAttribute()
    {
        if(auth()->check()){
            if(auth()->user()->currency_code){
              $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
              return number_format($this->attributes['required_amount'] * $exchange_rate,2);
            }
        }
        return number_format($this->attributes['required_amount'],2);
    }

    public function getPaidAmountAttribute()
    {
        if(auth()->check()){
            if(auth()->user()->currency_code){
              $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
              return number_format($this->attributes['paid_amount'] * $exchange_rate,2);
            }
        }
        return number_format($this->attributes['paid_amount'],2);
    }


    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function priceType()
    {
        return $this->belongsTo(PriceTypes::class, 'price_type_id', 'id');
    }

    // public function getPaidAmountAttribute() {
    //     return number_format(CarFinanceOperations::where(['car_id' => $this->car_id,'price_type_id' => $this->price_type_id])->sum('amount'),2);
    // }
}
