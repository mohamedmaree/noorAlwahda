<?php

namespace App\Models;

class CarFinance extends BaseModel
{
    const IMAGEPATH = 'carfinances' ; 

    protected $fillable = ['car_id','price_type_id' ,'required_amount','paid_amount'];

    protected $casts = [
        'required_amount'   => 'decimal:0',
        'paid_amount'       => 'decimal:0',
    ];
    
    public function scopeSearch($query, $searchArray = [])
    {
        $query->where(function ($query) use ($searchArray) {
            if ($searchArray) {
                foreach ($searchArray as $key => $value) {
                    if (str_contains($key, '_id')) { 
                        if ($value != null) {
                            $query->Where($key , $value);
                        }
                    }elseif ($key == 'order' ) {
                    }elseif ($key == 'created_at_min' ) { 
                        if ($value != null ) {
                            $query->WhereDate('created_at' , '>=' , $value);
                        }
                    }elseif ($key == 'created_at_max') { 
                        if ($value != null ) {
                            $query->WhereDate('created_at' , '<=' , $value);
                        }
                   }elseif ($key == 'price_types') { 
                          if ($value != null ) {
                              $query->whereJsonContains('price_type_id' , (string)$value);
                          }
                    }elseif ($key == 'userid') { 
                        if ($value != null ) {
                            $cars_ids = Car::where('user_id',$value)->pluck('id')->toArray();
                            $query->whereIn('car_id' ,$cars_ids);
                        }
                    }else{
                        if ($value != null ) {
                            $query->Where($key, 'like', '%'.$value.'%');
                        }
                    }
                }
            }
        });
        return $query->orderBy('created_at' , request()->searchArray && request()->searchArray['order'] ? request()->searchArray['order'] : 'DESC' );
    }
    public function getRequiredAmountAttribute()
    {
        if(auth()->check()){
            if(auth()->user()->currency_code){
              $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
              return number_format($this->attributes['required_amount'] * $exchange_rate);
            }
        }
        return number_format($this->attributes['required_amount']);
    }

    public function getPaidAmountAttribute()
    {
        if(auth()->check()){
            if(auth()->user()->currency_code){
              $exchange_rate = Country::where('currency_code',auth()->user()->currency_code)->first()->exchange_rate??1;
              return number_format($this->attributes['paid_amount'] * $exchange_rate);
            }
        }
        return number_format($this->attributes['paid_amount']);
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
