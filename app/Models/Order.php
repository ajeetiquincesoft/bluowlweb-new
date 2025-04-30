<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function OrderitemDartaWithOrder()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
    public function CustomerDartaWithOrder()
    {
        return $this->hasone(User::class,'id','customer_id');
    }

}
