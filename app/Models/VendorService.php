<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{
    use HasFactory;
    public function vendorserviveUserwithvendor()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

}
