<?php

namespace Database\Seeders;

use App\Models\Migrasi\transactionMigrasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Genders
        DB::table('genders')->insert([
            ['name' => "Laki"],
            ['name' => "Perempuan"]
        ]);

        // 2. Seed Roles con IDs explícitos
        DB::table('roles')->insert([
            ['id' => 1, 'name' => "Admin"],
            ['id' => 2, 'name' => "Restaurant"],
            ['id' => 3, 'name' => "Customer"]
        ]);

        // 3. Seed Users (reducido a solo los esenciales)
        DB::table('users')->insert([
            // ADMIN (role_id = 1)
            [
                'username' => "admin",
                'password' => Hash::make('admin'),
                'full_name' => "Admin Admin",
                'date_of_birth' => "2002-10-10",
                'address' => "Jalan Admin Admin No. 45",
                'email' => "admin@gmail.com",
                'phone' => "+62812431511",
                'gender' => 1,
                'balance' => 111111,
                'role_id' => 1, // Admin
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],

            // RESTAURANT OWNERS (role_id = 2)
            [
                'username' => "resto1",
                'password' => Hash::make(123),
                'full_name' => "Marco Melvin",
                'date_of_birth' => "2002-10-22",
                'address' => "Jalan Bukit Sikatan No. 11",
                'email' => "marco@gmail.com",
                'phone' => "+628128391839",
                'gender' => 2,
                'balance' => 123512512,
                'role_id' => 2, // Restaurant
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => "resto2",
                'password' => Hash::make(123),
                'full_name' => "Sachio Christopher",
                'date_of_birth' => "2002-03-02",
                'address' => "Jalan Kalijudan No. 1",
                'email' => "sachio@gmail.com",
                'phone' => "+62812346800976",
                'gender' => 1,
                'balance' => 1341414,
                'role_id' => 2, // Restaurant
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],

            // CUSTOMERS (role_id = 3)
            [
                'username' => "customer1",
                'password' => Hash::make(123),
                'full_name' => "Gabriella Sanchia",
                'date_of_birth' => "2002-12-11",
                'address' => "Di Hatinya Melvin No. 1",
                'email' => "gabriella@gmail.com",
                'phone' => "+62812314141",
                'gender' => 2,
                'balance' => 123141,
                'role_id' => 3, // Customer
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => "customer2",
                'password' => Hash::make(123),
                'full_name' => "Alicia Kosman",
                'date_of_birth' => "2002-08-02",
                'address' => "Jalan Dekat Situ No. 2",
                'email' => "alis@gmail.com",
                'phone' => "+6283151421",
                'gender' => 1,
                'balance' => 1123231,
                'role_id' => 3, // Customer
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 4. Seed Restaurants (asociados a usuarios Restaurant)
        DB::table('restaurants')->insert([
            [
                'full_name' => "Ottis Halvorson",
                'address' => "46708 Doris Shore East Amarimouth, WV 06848-4154",
                'phone' => "351-870-5610",
                'user_id' => 2, // Asociado a resto1 (user_id 2)
                'col' => 5,
                'row' => 3,
                'average_rating' => 4.5,
                'start_time' => 10,
                'shifts' => 9,
                'price' => 20000,
                'description' => "Magnam cupiditate odit labore voluptates dolore temporibus nam voluptas qui et quos temporibus quos et debitis unde atque ut sed quam molestiae ut.",
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'full_name' => "Raphael Nolan",
                'address' => "8295 Bartell Springs North Dawntown, AK 62311",
                'phone' => "(614) 389-4923",
                'user_id' => 3, // Asociado a resto2 (user_id 3)
                'col' => 5,
                'row' => 4,
                'average_rating' => 4.7,
                'start_time' => 9,
                'shifts' => 8,
                'price' => 20000,
                'description' => "Totam quia exercitationem voluptates blanditiis et non quibusdam omnis est commodi eum quia a omnis deserunt molestias amet illum officia excepturi voluptatibus impedit.",
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // 5. Seed Tables (reducido a solo algunos ejemplos)
        DB::table('tables')->insert([
            ['restaurant_id' => 1, 'seats' => 2, 'status' => 1],
            ['restaurant_id' => 1, 'seats' => 4, 'status' => 1],
            ['restaurant_id' => 1, 'seats' => 6, 'status' => 1],
            ['restaurant_id' => 2, 'seats' => 2, 'status' => 1],
            ['restaurant_id' => 2, 'seats' => 4, 'status' => 1]
        ]);

        // 6. Seed otros datos de prueba (reducidos)
        \App\Models\Migrasi\favouriteMigrasi::factory(3)->create();
        \App\Models\Migrasi\reservationMigrasi::factory(10)->create();
        \App\Models\Migrasi\reviewMigrasi::factory(20)->create();
        \App\Models\Migrasi\postMigrasi::factory(3)->create();

        for ($i = 0; $i < 10; $i++) {
            \App\Models\Migrasi\transactionMigrasi::factory()->create();
        }
    }
}
