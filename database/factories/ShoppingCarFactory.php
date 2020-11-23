<?php

namespace Database\Factories;

use App\Models\ShoppingCar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingCarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShoppingCar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_productID' => $this->faker->numberBetween($min = 1, $max = 10),
            'fk_saleID' => $this->faker->numberBetween($min = 1, $max = 10),
            'amount' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
