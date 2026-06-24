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
        DB::table('bookings')->insert([
            [
                'kode' => 'BK001',
                'customer' => 'Lailatul',
                'jenis_servis' => 'Alternator',
                'status' => 'proses'
            ],
            [
                'kode' => 'BK002',
                'customer' => 'Budi',
                'jenis_servis' => 'Dinamo Starter',
                'status' => 'proses'
            ],
            [
                'kode' => 'BK003',
                'customer' => 'Andi',
                'jenis_servis' => 'Kelistrikan',
                'status' => 'selesai'
            ]
        ]);
    }
}