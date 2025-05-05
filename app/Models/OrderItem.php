<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ServiceCalegoryDataWithOrderitem()
    {
        return $this->hasone(ServiceCategory::class, 'id', 'service_categories_id');
    }
    public function getServiceCategoryData($id)
    {
        return ($this->ServiceCalegoryDataWithOrderitem()->whereId($id)->first()) ? $this->ServiceCalegoryDataWithOrderitem()->whereId($id)->first() : '';
    }
}
