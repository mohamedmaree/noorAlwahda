<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class FuelTypes extends BaseModel
{
    const IMAGEPATH = 'fueltypes' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
