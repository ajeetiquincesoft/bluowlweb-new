<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSubscription extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'subscription_plan_id', 'stripe_subscription_id', 'starts_at', 'ends_at'];

    public function plan()
    {
        return $this->hasOne(Subscription::class,'id','subscriptions_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
