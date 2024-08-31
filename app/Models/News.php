<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class News extends BaseModel
{
    const IMAGEPATH = 'news' ; 

    use HasTranslations; 
    protected $fillable = ['content','vip','middle','usual','main_account','sub_account'];
    public $translatable = ['content'];
    protected $casts = [
        'vip'         => 'boolean',
        'middle'      => 'boolean',
        'usual'       => 'boolean',
        'main_account'      => 'boolean',
        'sub_account'       => 'boolean',
    ];
}
