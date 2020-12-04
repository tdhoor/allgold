<?php

namespace Database\Factories;

use App\Models\RefillCar;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefillCarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefillCar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fk_productId' => $this->faker->numberBetween($min = 1, $max = 10),
            'fk_refillId' => $this->faker->numberBetween($min = 1, $max = 10),
            'amount' => $this->faker->numberBetween($min = 10, $max = 50)
        ];
    }
}
