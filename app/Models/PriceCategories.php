<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class PriceCategories extends BaseModel
{
    const IMAGEPATH = 'pricecategories' ; 

    use HasTranslations; 
    protected $fillable = ['name','price_types_ids' ];
    public $translatable = ['name'];
    
    protected $casts = [
        'price_types_ids' => 'array',
    ];


    public function scopeSearch($query, $searchArray = [])
    {
        $query->where(function ($query) use ($searchArray) {
            if ($searchArray) {
                foreach ($searchArray as $key => $value) {
                    if (str_contains($key, '_id')) { 
                        if ($value != null) {
                            $query->Where($key , $value);
                        }
                    }elseif ($key == 'order' ) {
                    }elseif ($key == 'created_at_min' ) { 
                        if ($value != null ) {
                            $query->WhereDate('created_at' , '>=' , $value);
                        }
                    }elseif ($key == 'created_at_max') { 
                        if ($value != null ) {
                            $query->WhereDate('created_at' , '<=' , $value);
                        }
                   }elseif ($key == 'price_types') { 
                          if ($value != null ) {
                              $query->whereJsonContains('price_types_ids' , (string)$value);
                          }
                    }else{
                        if ($value != null ) {
                            $query->Where($key, 'like', '%'.$value.'%');
                        }
                    }
                }
            }
        });
        return $query->orderBy('created_at' , request()->searchArray && request()->searchArray['order'] ? request()->searchArray['order'] : 'DESC' );
    }

    public function priceTypes(){
        return PriceTypes::whereIn('id',$this->price_types_ids??[])->get();
    }


}
