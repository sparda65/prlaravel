<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image(){
        return $this->belongsTo(Image::class, 'image_id', 'id');
        //return $this->belongsTo('App\Models\Image', 'image_id');
    }
}
