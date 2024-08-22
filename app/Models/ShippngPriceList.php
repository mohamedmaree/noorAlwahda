<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class ShippngPriceList extends BaseModel
{
    const IMAGEPATH = 'shippngpricelists' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image','vip'];
    public $translatable = ['name'];
    protected $casts = [
        'vip'         => 'boolean',
    ];
}
