<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class transmissionTypes extends BaseModel
{
    const IMAGEPATH = 'transmissiontypes' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
