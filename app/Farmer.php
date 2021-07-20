<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $table = 'farmer';
    protected $fillable =['name', 'phone_number', 'PIN', 'address', 'city', 'bank_type', 'agriculture_category'];
}
