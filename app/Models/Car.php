<?php

namespace App\Models;


class Car extends BaseModel
{
    const IMAGEPATH = 'cars' ; 

    protected $fillable = ['car_num','lot','vin','user_id','car_brand_id','car_model_id','car_color_id','car_year_id','image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carBrand(){
        return $this->belongsTo(CarBrands::class,'car_brand_id','id');
    }
    public function carModel(){
        return $this->belongsTo(CarModels::class,'car_model_id','id');
    }
    public function carColor(){
        return $this->belongsTo(CarColors::class,'car_color_id','id');
    }
    public function carYear(){
        return $this->belongsTo(CarYears::class,'car_year_id','id');
    }

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
          $lastId = self::max('id') ?? 0;
          $model->car_num = date('Y') . ($lastId + 1);
        });
      }

}
