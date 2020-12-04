<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefillCar extends Model
{
    use HasFactory;
    protected $table = 'refill_cars';
    protected $primaryKey = 'refillCarId';
    public $timestamps = true;
}
