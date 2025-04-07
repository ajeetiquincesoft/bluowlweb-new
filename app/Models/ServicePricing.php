<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePricing extends Model
{
    use HasFactory;
    public function servicewithpricing()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }
    public function categorywithpricing()
    {
        return $this->hasOne(ServiceCategory::class,'id','service_category_id');

    }
}
