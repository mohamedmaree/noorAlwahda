<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Auction extends BaseModel
{
    const IMAGEPATH = 'auctions' ; 

    use HasTranslations; 
    protected $fillable = ['name' ,'image'];
    public $translatable = ['name'];

}
