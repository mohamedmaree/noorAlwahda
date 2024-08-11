<?php

namespace App\Models;

class CarGallery extends BaseModel
{
    const IMAGEPATH = 'cargalleries' ; 

    protected $fillable = ['car_id','car_status_id' ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function carStatus()
    {
        return $this->belongsTo(CarStatus::class, 'car_status_id', 'id');
    }

    public function images(){
        return $this->hasMany(CarGalleryImages::class, 'car_gallery_id', 'id');
    }
}
