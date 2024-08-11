<?php

namespace App\Models;

class CarGalleryImages extends BaseModel
{
    const IMAGEPATH = 'cargalleryimages' ; 

    protected $fillable = ['car_gallery_id' ,'image'];

    public function carGallery(){
        return $this->belongsTo(CarGallery::class, 'car_gallery_id', 'id');
    }

}
