<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Warehouse extends BaseModel
{
    const IMAGEPATH = 'warehouses' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

}
