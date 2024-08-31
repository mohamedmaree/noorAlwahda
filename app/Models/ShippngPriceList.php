<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class ShippngPriceList extends BaseModel
{
    const IMAGEPATH = 'shippngpricelists' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image','vip','middle','usual','main_account','sub_account'];
    public $translatable = ['name'];
    protected $casts = [
        'vip'         => 'boolean',
        'middle'      => 'boolean',
        'usual'       => 'boolean',
        'main_account'      => 'boolean',
        'sub_account'       => 'boolean',
    ];
}
