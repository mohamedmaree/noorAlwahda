<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use App\Models\Category;

class CarStatus extends BaseModel
{
    const IMAGEPATH = 'carstatuses' ; 

    use HasTranslations; 
    protected $fillable = ['name','num_days','sort','fields'];
    public $translatable = ['name'];
    protected $casts = [
        'fields' => 'array',
    ];
    public function category(){
        return Category::whereJsonContains('car_statuses_ids' , (string)$this->id)->first();
    }

}
