<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    public function comments(){
        // modelo al que se hace referencia
        // llave foranea de la tabla a la que se hace referencia
        // llave primaria de la clase actual
        return $this->hasMany(Comment::class, 'image_id', 'id')->orderBy('id', 'desc');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'image_id', 'id');
    }

    public function user(){
        // modelo al que se hace referencia
        // llave foranea de la tabla de la clase actual
        // llave primaria al que se hace referencia
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
