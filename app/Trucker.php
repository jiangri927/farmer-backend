<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trucker extends Model
{
    protected $table = 'truckers';
    protected $fillable =['name', 'phone_number', 'PIN', 'address', 'city', 'bank_type', 'validated_id', 'validated_status'];
}
