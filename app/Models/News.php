<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class News extends BaseModel
{
    const IMAGEPATH = 'news' ; 

    use HasTranslations; 
    protected $fillable = ['content','vip'];
    public $translatable = ['content'];
    protected $casts = [
        'vip'         => 'boolean',
    ];
}
