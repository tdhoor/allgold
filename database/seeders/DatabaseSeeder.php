<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Station;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\ShoppingCar;
use App\Models\Refill;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(30)->create();
        Station::factory(30)->create();
        Inventory::factory(30)->create();
        Sale::factory(10)->create();
        ShoppingCar::factory(10)->create();
        Refill::factory(10)->create();
    }
}
