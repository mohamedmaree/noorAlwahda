<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CarBrands extends BaseModel
{
    const IMAGEPATH = 'carbrands' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

    public function models()
    {
        return $this->hasMany(CarModels::class,'car_brand_id','id');
    }
}
