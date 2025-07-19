<?php

namespace Database\Factories\Migrasi;

use App\Models\Migrasi\reservationMigrasi;
use App\Models\Migrasi\userMigrasi;
use App\Models\Migrasi\restaurantMigrasi;
use App\Models\Migrasi\tableMigrasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationMigrasiFactory extends Factory
{
    protected $model = reservationMigrasi::class;

    public function definition()
    {
        // Obtener usuarios, restaurantes y mesas existentes o crear nuevos
        $userIds = userMigrasi::where('role_id', 3)->pluck('id')->toArray(); // Solo clientes
        $restaurantIds = restaurantMigrasi::pluck('id')->toArray();

        $restaurantId = $this->faker->randomElement($restaurantIds);
        $tableIds = tableMigrasi::where('restaurant_id', $restaurantId)->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'restaurant_id' => $restaurantId,
            'table_id' => $this->faker->randomElement($tableIds),
            'reservation_date_time' => $this->faker->dateTimeBetween('-1 year', '+2 months'),
            'payment_status' => $this->faker->randomElement([0, 1]), // Usar números en lugar de strings
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now()
        ];
    }

    /**
     * Estado: Reservación pagada
     */
    public function paid()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_status' => 1,
            ];
        });
    }

    /**
     * Estado: Reservación no pagada
     */
    public function unpaid()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_status' => 0,
            ];
        });
    }

    /**
     * Estado: Reservación futura
     */
    public function upcoming()
    {
        return $this->state(function (array $attributes) {
            return [
                'reservation_date_time' => $this->faker->dateTimeBetween('+1 day', '+2 months'),
            ];
        });
    }

    /**
     * Estado: Reservación pasada
     */
    public function past()
    {
        return $this->state(function (array $attributes) {
            return [
                'reservation_date_time' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
            ];
        });
    }
}
