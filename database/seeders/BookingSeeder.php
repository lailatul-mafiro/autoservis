<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lailatul = DB::table('users')->where('name', 'Lailatul')->first();
        $budi = DB::table('users')->where('name', 'Budi')->first();
        $andi = DB::table('users')->where('name', 'Andi')->first();

        DB::table('bookings')->insert([
            [
                'kode' => 'BK001',
                'user_id' => $lailatul?->id,
                'customer' => 'Lailatul',
                'jenis_servis' => 'Alternator',
                'status' => 'proses',
                'tanggal_masuk' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'BK002',
                'user_id' => $budi?->id,
                'customer' => 'Budi',
                'jenis_servis' => 'Dinamo Starter',
                'status' => 'proses',
                'tanggal_masuk' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'BK003',
                'user_id' => $andi?->id,
                'customer' => 'Andi',
                'jenis_servis' => 'Kelistrikan',
                'status' => 'selesai',
                'tanggal_masuk' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}