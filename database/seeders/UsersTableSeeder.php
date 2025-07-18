<?php

namespace Database\Seeders;

use App\Models\Migrasi\userMigrasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar la tabla primero (opcional)
        // userMigrasi::truncate();

        // Crear usuario admin
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

        // Crear usuario de restaurante
        userMigrasi::create([
            'username' => 'restaurant1',
            'password' => Hash::make('resto123'),
            'full_name' => 'Restaurant Owner',
            'date_of_birth' => '1990-05-15',
            'address' => '456 Food Avenue',
            'email' => 'resto@example.com',
            'phone' => '0987654321',
            'gender' => 1,
            'balance' => 5000,
            'blocked' => 0,
            'role_id' => 2, // Restaurant
            'verified_at' => now()
        ]);

        // Crear usuario cliente
        userMigrasi::create([
            'username' => 'customer1',
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

        // Crear múltiples usuarios de prueba (opcional)
        // userMigrasi::factory()->count(10)->create();
    }
}
