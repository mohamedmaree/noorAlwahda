<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class DamageTypes extends BaseModel
{
    const IMAGEPATH = 'damagetypes' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

}
