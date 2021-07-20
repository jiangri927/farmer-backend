<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    protected $table = 'traders';
    protected $fillable =['name', 'phone_number', 'PIN', 'address', 'city', 'bank_type', 'validated_id', 'validated_status'];
}
