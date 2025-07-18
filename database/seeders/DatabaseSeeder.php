<?php

namespace Database\Seeders;

use App\Models\Migrasi\userMigrasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed géneros
        DB::table('genders')->insert([
            ['name' => "Laki"],
            ['name' => "Perempuan"]
        ]);

        // 2. Seed roles
        DB::table('roles')->insert([
            ['name' => "Admin"],
            ['name' => "Customer"],
            ['name' => "Restaurant"]
        ]);

        // 3. Seed usuarios usando el modelo userMigrasi
        $users = [
            // Administradores (role_id 1)
            [
                'username' => "admin1",
                'password' => Hash::make('Admin123!'),
                'full_name' => "Administrator 1",
                'date_of_birth' => "1980-01-01",
                'address' => "Admin Address 123",
                'email' => "admin1@example.com",
                'phone' => "+628123456789",
                'gender' => 1,
                'balance' => 1000000,
                'role_id' => 1,
                'verified_at' => now()
            ],

            // Restaurantes (role_id 3)
            [
                'username' => "resto1",
                'password' => Hash::make('Resto123!'),
                'full_name' => "Restaurant Owner 1",
                'date_of_birth' => "1985-05-15",
                'address' => "Restaurant Street 1",
                'email' => "resto1@example.com",
                'phone' => "+628987654321",
                'gender' => 1,
                'balance' => 500000,
                'role_id' => 3,
                'verified_at' => now()
            ],

            // Clientes (role_id 2)
            [
                'username' => "customer1",
                'password' => Hash::make('Customer123!'),
                'full_name' => "Regular Customer",
                'date_of_birth' => "1995-10-20",
                'address' => "Customer Lane 456",
                'email' => "customer1@example.com",
                'phone' => "+628111222333",
                'gender' => 2,
                'balance' => 100000,
                'role_id' => 2,
                'verified_at' => now()
            ]
        ];

        foreach ($users as $userData) {
            userMigrasi::create($userData);
        }

        // 4. Seed restaurantes
        $restaurants = [
            [
                'full_name' => "Ottis Halvorson",
                'address' => "46708 Doris Shore, East Amarimouth",
                'phone' => "351-870-5610",
                'user_id' => 2, // Asegúrate que este ID corresponda a un usuario restaurante
                'col' => 5,
                'row' => 3,
                'average_rating' => 4.5,
                'start_time' => 10,
                'shifts' => 9,
                'price' => 20000,
                'description' => "Magnam cupiditate odit labore voluptates dolore temporibus.",
                'verified_at' => now()
            ],
            // ... otros restaurantes
        ];

        DB::table('restaurants')->insert($restaurants);

        // 5. Seed mesas (optimizado)
        $tables = [];
        $restaurantIds = DB::table('restaurants')->pluck('id');

        foreach ($restaurantIds as $restaurantId) {
            for ($i = 1; $i <= 20; $i++) {
                $tables[] = [
                    'restaurant_id' => $restaurantId,
                    'seats' => $i,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('tables')->insert($tables);

        // 6. Seed datos adicionales con factories
        \App\Models\Migrasi\favouriteMigrasi::factory(3)->create();
        \App\Models\Migrasi\reservationMigrasi::factory(20)->create();
        \App\Models\Migrasi\reviewMigrasi::factory(50)->create();
        \App\Models\Migrasi\postMigrasi::factory(5)->create();

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Migrasi\transactionMigrasi::factory()->create();
        }
    }
}
