<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCar extends Model
{
    use HasFactory;
    protected $table = 'shoppingcars';
    protected $primaryKey = 'shoppingcarId';
    public $timestamps = true;
}
