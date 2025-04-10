<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGallery extends Model
{
    use HasFactory;
    public function vendorwithgallery()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
