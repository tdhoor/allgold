<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCar extends Model
{
    use HasFactory;
    protected $table = 'shopping_cars';
    protected $primaryKey = 'shoppingCarID';
    public $timestamps = true;
}
