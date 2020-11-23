<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_stationID' => $this->faker->numberBetween($min = 1, $max = 10),
            'totalPrice' => $this->faker->randomFloat(2, 1, 100 )
        ];
    }
}
