<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_productID' => $this->faker->numberBetween($min = 1, $max = 10),
            'fk_stationID' => $this->faker->numberBetween($min = 1, $max = 10),
            'currentAmount' => $this->faker->numberBetween($min = 10, $max = 1000),
            'targetAmount' => $this->faker->numberBetween($min = 10, $max = 100)
        ];
    }
}
