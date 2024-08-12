<?php

namespace App\Models;

class CarStatusHistory extends BaseModel
{
    const IMAGEPATH = 'carstatushistories' ; 

    protected $fillable = ['car_id','car_status_id' ,'start_date','end_date'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function carStatus()
    {
        return $this->belongsTo(CarStatus::class, 'car_status_id', 'id');
    }
}
