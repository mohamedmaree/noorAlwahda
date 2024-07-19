<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class PriceTypes extends BaseModel
{
    const IMAGEPATH = 'pricetypes' ; 

    use HasTranslations; 
    protected $fillable = ['name'];
    public $translatable = ['name'];

}
