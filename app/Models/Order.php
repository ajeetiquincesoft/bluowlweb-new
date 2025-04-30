<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        // Exclude records where status is 4
        static::addGlobalScope('excludeStatus4', function (Builder $builder) {
            $builder->where('status', '!=', 2);
        });

        // Order records by `created_at` in descending order
        static::addGlobalScope('orderByCreatedAtDesc', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
    public function OrderitemDartaWithOrder()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
    public function CustomerDartaWithOrder()
    {
        return $this->hasone(User::class,'id','customer_id');
    }

}
