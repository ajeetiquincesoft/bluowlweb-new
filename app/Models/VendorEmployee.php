<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorEmployee extends Model
{
    use HasFactory;
    public function employeeUserwithvendor()
    {
        return $this->hasOne(User::class,'id','employee_user_id');
    }
}
