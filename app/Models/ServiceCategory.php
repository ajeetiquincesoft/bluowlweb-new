<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    public function categorywithservice()
    {
        return $this->hasOne(Service::class,'id','service_id');

    }
    public function getservicedata($id)
    {
        return ($this->categorywithservice()->where('id', $id)->first()) ? $this->categorywithservice()->where('id', $id)->first() : '';
    }
}
