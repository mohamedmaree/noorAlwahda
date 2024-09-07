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

    public function getImageAttribute() {
        if (isset($this->attributes['image'])) {
            $image = $this->getImage($this->attributes['image'], static::IMAGEPATH);
        } else {
            $image = $this->defaultImage( static::IMAGEPATH);
        }
        return $image;
    }

    public function setImageAttribute($value) {
        if (null != $value && is_file($value) ) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'] , static::IMAGEPATH) : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }elseif(null != $value){
            $this->attributes['image'] = $value;
        }
    }

}
