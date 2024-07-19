<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CarModels extends BaseModel
{
    const IMAGEPATH = 'carmodels' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'car_brand_id','image'];
    public $translatable = ['name'];

    public function brand()
    {
        return $this->belongsTo(CarBrands::class, 'car_brand_id', 'id');
    }

}
