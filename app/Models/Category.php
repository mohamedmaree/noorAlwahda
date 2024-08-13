<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use App\Models\Car;

class Category extends BaseModel
{
    use HasTranslations;

    const IMAGEPATH = 'categories' ; 

    protected $fillable = ['name','is_active','car_statuses_ids','level' ,'image'];
    public $translatable = ['name'];
    
    protected $casts = [
        'car_statuses_ids' => 'array',
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
                     }elseif ($key == 'car_statuses') { 
                            if ($value != null ) {
                                $query->whereJsonContains('car_statuses_ids' , (string)$value);
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

    public function numcars(){
        return Car::whereIn('car_status_id',$this->car_statuses_ids??[])->count();
    }
    // public function childes(){
    //     return $this->hasMany(self::class,'parent_id');
    // }

    // public function parent(){
    //      return $this->belongsTo(self::class,'parent_id');
    // }


    // public function subChildes()
    // {
    //      return $this->childes()->with( 'subChildes' );
    // }

    // public function subParents()
    // {
    //     return $this -> parent()->with('subParents');
    // }

    // public function getAllChildren ()
    // {
    //     $sections = new Collection();
    //     foreach ($this->childes as $section) {
    //         $sections->push($section);
    //         $sections = $sections->merge($section->getAllChildren());
    //     }
    //     return $sections;
    // }

    // public function getAllParents()
    // {
    //     $parents = collect([]);

    //     $parent = $this->parent;

    //     while(!is_null($parent)) {
    //         $parents->prepend($parent);
    //         $parent = $parent->parent;
    //     }
    //     return $parents;
    // }

    // public function getFullPath(){
    //     $parents  = $this->getAllParents () ;
    //     $current  = Category::where('id',$this->id)->get();
    //     $parents  = $parents->merge($current);
    //     $childs   = $this->getAllChildren () ;
    //     $path     = $childs->merge($parents);
    //     return $path ;
    // }


    // public function getFollowedCategoryAttribute()
    // {
    //     if ($this->attributes['parent_id']) {
    //         return $this->parent->name;
    //     } else {
    //         return __('admin.main_section');
    //     }
    // }


    public function scopeActive($query){
        return $query->where('is_active',1);
    }


}
