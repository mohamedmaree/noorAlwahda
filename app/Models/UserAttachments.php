<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class UserAttachments extends BaseModel
{
    const IMAGEPATH = 'userattachments' ; 

    use HasTranslations; 
    protected $fillable = ['user_id','name' ,'image'];
    public $translatable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
