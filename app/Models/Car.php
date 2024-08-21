<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\CarStatus;

class Car extends BaseModel
{
    const IMAGEPATH = 'cars' ; 

    protected $fillable = ['car_num',
                           'lot',
                           'vin',
                           'user_id',
                           'car_brand_id',
                           'car_model_id',
                           'car_color_id',
                           'car_year_id',
                           'car_status_id',

                           'car_damage_type_id',
                           'car_body_type_id',
                           'car_engine_type_id',
                           'car_engine_cylinder_id',
                           'car_transmission_type_id',
                           'car_drive_type_id',
                           'car_fuel_type_id',
                           'auction_id',
                           'distance',
                           'key',

                           'from_country_id',
                           'region_id',
                           'to_country_id',
                           'warehouse_id',
                           'pickup_location_id',
                           'container',
                           'available',
                           
                           'purchasing_date',
                           'estimation_arrive_date',
                           'warehouse_arrive_date',
                           'company_arrive_date',
                           'port_arrive_date',
                           'shipping_date',
                           'towing_date',

                           'notes',
                           'image'];

    protected $casts = [
        'available'      => 'boolean',
    ];

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

    public function carDamage(){
        return $this->belongsTo(DamageTypes::class,'car_damage_type_id','id');
    }

    public function carBodyType(){
        return $this->belongsTo(BodyTypes::class,'car_body_type_id','id');
    }

    public function carEngineType(){
        return $this->belongsTo(EngineTypes::class,'car_engine_type_id','id');
    }

    public function carEngineCylinder(){
        return $this->belongsTo(EngineCylinders::class,'car_engine_cylinder_id','id');
    }

    public function carTransmissionType(){
        return $this->belongsTo(transmissionTypes::class,'car_transmission_type_id','id');
    }

    public function carDriveType(){
        return $this->belongsTo(DriveTypes::class,'car_drive_type_id','id');
    }

    public function carFuelType(){
        return $this->belongsTo(FuelTypes::class,'car_fuel_type_id','id');
    }

    public function carAcution(){
        return $this->belongsTo(Auction::class,'auction_id','id');
    }

    public function carFromCountry(){
        return $this->belongsTo(Country::class,'from_country_id','id');
    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id','id');
    }

    public function carToCountry(){
        return $this->belongsTo(Country::class,'to_country_id','id');
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

    public function pickupLocation(){
        return $this->belongsTo(Branch::class,'pickup_location_id','id');
    }

    public function statusHistory(){
        return $this->hasMany(CarStatusHistory::class,'car_id','id');
    }

    public function carGalleries(){
        return $this->hasMany(CarGallery::class,'car_id','id');
    }
    
    public function carAttachments(){
        return $this->hasMany(CarAttachment::class,'car_id','id');
    }

    public function carFinance(){
        return $this->hasMany(CarFinance::class,'car_id','id');
    }

    public function carFinanceOperations(){
        return $this->hasMany(CarFinanceOperations::class,'car_id','id');
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
          $model->car_num = 'AL0000' . ($lastId + 1);
        });
      }

}
