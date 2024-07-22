<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class BodyTypes extends BaseModel
{
    const IMAGEPATH = 'bodytypes' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

}
