<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class StationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Station::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'coordsA' => $this->faker->latitude($min = -90, $max = 90),
            'coordsB' => $this->faker->longitude($min = -180, $max = 180),
            'location' => $this->faker->country,
            'type' => $this->faker->randomLetter,
            'description' => $this->faker->word,
        ];
    }
}
