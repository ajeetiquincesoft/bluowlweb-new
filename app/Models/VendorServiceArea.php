<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorServiceArea extends Model
{
    use HasFactory;
    public function getVendorSubscription()
    {
        return $this->hasOne(VendorSubscription::class,'vendor_id','user_id');
    }
}
