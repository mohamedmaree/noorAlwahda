<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class EngineCylinders extends BaseModel
{
    const IMAGEPATH = 'enginecylinders' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
