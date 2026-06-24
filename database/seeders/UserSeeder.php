<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@autoservis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_hp' => '081234567890',
            'foto' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Customer Demo',
            'email' => 'customer@autoservis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'no_hp' => '081298765432',
            'foto' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Lailatul',
            'email' => 'lailatul@autoservis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'no_hp' => '081211112222',
            'foto' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@autoservis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'no_hp' => '081233334444',
            'foto' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Andi',
            'email' => 'andi@autoservis.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'no_hp' => '081255556666',
            'foto' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}