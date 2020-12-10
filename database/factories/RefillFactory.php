<?php

namespace Database\Factories;

use App\Models\Refill;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Refill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_stationId' => $this->faker->numberBetween($min = 1, $max = 10),
            'fk_productId' => $this->faker->numberBetween($min = 1, $max = 10),
            'amount' => $this->faker->numberBetween($min = 10, $max = 50),
            'status' => 'open'
        ];
    }
}
