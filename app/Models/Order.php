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
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function OrderPaymentData()
    {
        return $this->hasone(Payment::class, 'order_id', 'id');
    }
    public function CustomerDartaWithOrder()
    {
        return $this->hasone(User::class, 'id', 'customer_id');
    }
    public function VendorDartaWithOrder()
    {
        return $this->hasone(User::class, 'id', 'vendor_id');
    }
    public function VendorAreaData()
    {
        return $this->hasone(VendorServiceArea::class, 'id', 'area_id');
    }
    public function getCustomerData($id)
    {
        return($this->CustomerDartaWithOrder()->whereId($id)->first())? $this->CustomerDartaWithOrder()->whereId($id)->first():'';
    }
    public function getVendorData($id)
    {
        return($this->VendorDartaWithOrder()->whereId($id)->first())? $this->VendorDartaWithOrder()->whereId($id)->first():'';
    }
    public function getVendorAreaData($id)
    {
        return($this->VendorAreaData()->whereId($id)->first())? $this->VendorAreaData()->whereId($id)->first():'';
    }
}
