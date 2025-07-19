<?php

namespace Database\Factories\Migrasi;

use App\Models\Migrasi\transactionMigrasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionMigrasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = transactionMigrasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(4,9),
            'restaurant_id' => $this->faker->numberBetween(1,3),
            'reservation_id' => $this->faker->unique()->numberBetween(1,20),
            'payment_amount' => $this->faker->randomFloat(2, 10000, 60000),
            'payment_date_at' => $this->faker->dateTimeBetween("-1 years", "now"),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
