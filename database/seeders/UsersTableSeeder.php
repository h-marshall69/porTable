<?php

namespace Database\Seeders;

use App\Models\Migrasi\userMigrasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario admin (rol_id = 3)
        userMigrasi::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'full_name' => 'Administrator',
            'date_of_birth' => '1985-01-01',
            'address' => '123 Admin Street',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'gender' => 1,
            'balance' => 10000,
            'blocked' => 0,
            'role_id' => 3, // Admin
            'verified_at' => now()
        ]);

        // Crear usuario cliente (rol_id = 1)
        userMigrasi::create([
            'username' => 'customer10',
            'password' => Hash::make('customer123'),
            'full_name' => 'Regular Customer',
            'date_of_birth' => '1995-10-20',
            'address' => '789 Customer Lane',
            'email' => 'customer@example.com',
            'phone' => '5551234567',
            'gender' => 2,
            'balance' => 1000,
            'blocked' => 0,
            'role_id' => 1, // Customer
            'verified_at' => now()
        ]);

        // Crear segundo usuario cliente (opcional)
        userMigrasi::create([
            'username' => 'customer20',
            'password' => Hash::make('customer456'),
            'full_name' => 'Premium Customer',
            'date_of_birth' => '1990-07-15',
            'address' => '101 Premium Road',
            'email' => 'premium@example.com',
            'phone' => '5557654321',
            'gender' => 1,
            'balance' => 5000,
            'blocked' => 0,
            'role_id' => 1, // Customer
            'verified_at' => now()
        ]);

        // Opcional: Crear múltiples usuarios cliente usando factory
        // userMigrasi::factory()->count(5)->create([
        //     'role_id' => 1 // Asegurar que sean customers
        // ]);
    }
}
