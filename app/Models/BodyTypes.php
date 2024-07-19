<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class BodyTypes extends BaseModel
{
    const IMAGEPATH = 'bodytypes' ; 

    use HasTranslations; 
    protected $fillable = ['title','description' ,'image'];
    public $translatable = ['title','description'];

}
