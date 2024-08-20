<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CarAttachment extends BaseModel
{
    const IMAGEPATH = 'carattachments' ; 

    use HasTranslations; 
    protected $fillable = ['car_id','name' ,'image'];
    public $translatable = ['name'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

}
