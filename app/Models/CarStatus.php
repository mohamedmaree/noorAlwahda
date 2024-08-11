<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CarStatus extends BaseModel
{
    const IMAGEPATH = 'carstatuses' ; 

    use HasTranslations; 
    protected $fillable = ['name','num_days','sort'];
    public $translatable = ['name'];

}
