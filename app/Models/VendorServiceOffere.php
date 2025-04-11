<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorServiceOffere extends Model
{
    use HasFactory;
    public function vendorserviceofferdata()
    {
        return $this->hasOne(ServiceCategory::class,'id','service_category_id');
    }
}
