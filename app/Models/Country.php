<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Country extends BaseModel
{
    use HasTranslations; 
    
    protected $fillable = ['name','key','currency','currency_code','exchange_rate','iso2','iso3','flag'];
    
    public $translatable = ['name','currency'];

    protected $casts = [
        'exchange_rate'  => 'decimal:3',
    ];
    
    public function regions()
    {
        return $this->hasMany(Region::class, 'country_id', 'id');
    }
    
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
