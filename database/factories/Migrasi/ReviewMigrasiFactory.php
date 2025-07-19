<?php

namespace Database\Factories\Migrasi;

use App\Models\Migrasi\reviewMigrasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewMigrasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = reviewMigrasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(4, 9),
            'restaurant_id' => $this->faker->numberBetween(1, 3),
            'rating' => $this->faker->numberBetween(3, 5),
            'message' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween("-1 years", "now"),
            'updated_at' => now(),
        ];
    }
}
