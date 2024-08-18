<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Branch extends BaseModel
{
    const IMAGEPATH = 'branches' ; 

    use HasTranslations; 
    protected $fillable = ['name','image'];
    public $translatable = ['name'];

}
