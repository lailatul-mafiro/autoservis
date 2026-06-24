<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan UserSeeder terlebih dahulu
        $this->call(UserSeeder::class);

        // Jalankan BookingSeeder setelah user dibuat
        $this->call(BookingSeeder::class);

        // Jalankan TransaksiSeeder untuk menyemai laporan dan data keuangan
        $this->call(TransaksiSeeder::class);

        // Semai data layanan awal agar halaman beranda/dashboard terisi
        \Illuminate\Support\Facades\DB::table('layanan')->insert([
            [
                'nama' => 'Alternator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dinamo Starter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kelistrikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
