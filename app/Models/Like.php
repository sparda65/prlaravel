<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes'; 

    public function user(){
        //return $this->belongsTo('App\Models\User', 'user_id');
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image(){
        //return $this->belongsTo('App\Models\Image', 'image_id');
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
}
