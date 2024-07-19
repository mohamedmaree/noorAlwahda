<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class CarColors extends BaseModel
{
    const IMAGEPATH = 'carcolors' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

}
