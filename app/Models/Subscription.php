<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'stripe_price_id','price', 'duration', 'description', 'features', 'status'];
    public function subscriptions()
    {
        return $this->hasMany(VendorSubscription::class);
    }
}
