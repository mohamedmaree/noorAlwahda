<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class EngineTypes extends BaseModel
{
    const IMAGEPATH = 'enginetypes' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
