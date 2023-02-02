<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cappi2022 extends Model
{
    protected $table = 'cappi2022';
    protected $fillable = ['full_name', 'inet', 'churn_reason', 'service_type', 'user_latitude','user_longitude','email','user_phone','localidad'];

   
}
