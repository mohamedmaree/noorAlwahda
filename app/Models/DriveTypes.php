<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class DriveTypes extends BaseModel
{
    const IMAGEPATH = 'drivetypes' ; 

    use HasTranslations; 
    protected $fillable = ['title','description' ,'image'];
    public $translatable = ['title','description'];

}
