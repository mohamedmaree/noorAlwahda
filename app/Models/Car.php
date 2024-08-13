<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\CarStatus;

class Car extends BaseModel
{
    const IMAGEPATH = 'cars' ; 

    protected $fillable = ['car_num','lot','vin','user_id','car_brand_id','car_model_id','car_color_id','car_year_id','car_status_id','image'];

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

    public function carStatus(){
        return $this->belongsTo(CarStatus::class,'car_status_id','id');
    }

    public function statusHistory(){
        return $this->hasMany(CarStatusHistory::class,'car_id','id');
    }

    public function carGalleries(){
        return $this->hasMany(CarGallery::class,'car_id','id');
    }
    

    public function carFinance(){
        return $this->hasMany(CarFinance::class,'car_id','id');
    }

    public function nextCarStatus(){
        return CarStatus::where('sort','>',$this->carStatus->sort??0)->orderBy('sort','ASC')->first();
    }
     
    public Function stillDays(){
        $daysBetween = null;
        if($lastStatus = $this->statusHistory()->where('car_status_id',$this->car_status_id)->latest()->first()){
            $numDays = $lastStatus->carStatus->num_days??0;
            $startDate = $lastStatus->start_date;

            $startDateTimestamp = strtotime($startDate);
            $endDateTimestamp = strtotime('+'.$numDays.' days', $startDateTimestamp);
            $endDate = date('Y-m-d', $endDateTimestamp);
            
            $todayTimestamp = strtotime(date('Y-m-d'));
            $daysBetween = ($endDateTimestamp - $todayTimestamp) / (60 * 60 * 24);
        }
        return $daysBetween;
    }
    

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
          $lastId = self::max('id') ?? 0;
          $model->car_num = date('Y') . ($lastId + 1);
        });
      }

}
