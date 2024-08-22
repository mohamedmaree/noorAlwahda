<?php

namespace App\Models;

class CarFinanceOperations extends BaseModel
{
    const IMAGEPATH = 'carfinanceoperations' ; 

    protected $fillable = ['car_id','price_type_id','amount' ,'image'];

    protected $casts = [
        'price_type_id' => 'array',
        'amount'   => 'decimal:2',
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

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function priceTypes(){
        return PriceTypes::whereIn('id',$this->price_type_id??[])->get();
    }

}
