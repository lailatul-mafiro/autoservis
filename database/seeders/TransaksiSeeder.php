<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil user untuk relasi
        $lailatul = DB::table('users')->where('name', 'Lailatul')->first();
        $budi = DB::table('users')->where('name', 'Budi')->first();
        $andi = DB::table('users')->where('name', 'Andi')->first();
        $demo = DB::table('users')->where('role', 'customer')->first();

        $userIds = array_filter([$lailatul?->id, $budi?->id, $andi?->id, $demo?->id]);
        if (empty($userIds)) {
            $userIds = [1]; // fallback jika tidak ada user
        }

        // Kosongkan tabel transaksi & transaksi_langsung lama agar tidak tumpang tindih
        DB::table('transaksi')->truncate();
        DB::table('transaksi_langsung')->truncate();

        // Hubungkan booking BK003 (Andi, Kelistrikan, status selesai) ke transaksi lunas
        $bk003 = DB::table('bookings')->where('kode', 'BK003')->first();
        if ($bk003) {
            DB::table('transaksi')->insert([
                'booking_id' => $bk003->id,
                'total_bayar' => 250000,
                'metode' => 'Cash',
                'status_bayar' => 'lunas',
                'catatan' => 'Perbaikan kelistrikan lampu utama selesai.',
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subMonths(1),
            ]);

            DB::table('bookings')->where('id', $bk003->id)->update([
                'status_bayar' => 'lunas',
                'harga' => 250000,
                'tanggal_selesai' => Carbon::now()->subMonths(1),
            ]);
        }

        // Tambah beberapa booking historis online beserta transaksinya
        $histBookings = [
            [
                'kode' => 'BK101',
                'customer' => 'Lailatul',
                'user_id' => $lailatul?->id ?? $userIds[0],
                'jenis_servis' => 'Alternator',
                'harga' => 500000,
                'status' => 'selesai',
                'status_bayar' => 'lunas',
                'tanggal_masuk' => Carbon::now()->subMonths(5),
                'tanggal_selesai' => Carbon::now()->subMonths(5),
                'created_at' => Carbon::now()->subMonths(5),
                'updated_at' => Carbon::now()->subMonths(5),
                'total_bayar' => 500000,
                'metode' => 'Transfer',
                'catatan' => 'Ganti dinamo alternator copotan orisinil.',
            ],
            [
                'kode' => 'BK102',
                'customer' => 'Budi',
                'user_id' => $budi?->id ?? $userIds[0],
                'jenis_servis' => 'Dinamo Starter',
                'harga' => 350000,
                'status' => 'selesai',
                'status_bayar' => 'lunas',
                'tanggal_masuk' => Carbon::now()->subMonths(4),
                'tanggal_selesai' => Carbon::now()->subMonths(4),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
                'total_bayar' => 350000,
                'metode' => 'Cash',
                'catatan' => 'Service dinamo starter & ganti carbon brush.',
            ],
            [
                'kode' => 'BK103',
                'customer' => 'Andi',
                'user_id' => $andi?->id ?? $userIds[0],
                'jenis_servis' => 'Tune Up',
                'harga' => 200000,
                'status' => 'selesai',
                'status_bayar' => 'lunas',
                'tanggal_masuk' => Carbon::now()->subMonths(3),
                'tanggal_selesai' => Carbon::now()->subMonths(3),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
                'total_bayar' => 200000,
                'metode' => 'Cash',
                'catatan' => 'Tune up injeksi & bersihkan filter udara.',
            ],
            [
                'kode' => 'BK104',
                'customer' => 'Lailatul',
                'user_id' => $lailatul?->id ?? $userIds[0],
                'jenis_servis' => 'Kelistrikan',
                'harga' => 150000,
                'status' => 'selesai',
                'status_bayar' => 'lunas',
                'tanggal_masuk' => Carbon::now()->subMonths(2),
                'tanggal_selesai' => Carbon::now()->subMonths(2),
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(2),
                'total_bayar' => 150000,
                'metode' => 'Transfer',
                'catatan' => 'Perbaikan sekring putus & ganti bohlam headlamp.',
            ]
        ];

        foreach ($histBookings as $hb) {
            $bookingId = DB::table('bookings')->insertGetId([
                'kode' => $hb['kode'],
                'user_id' => $hb['user_id'],
                'customer' => $hb['customer'],
                'jenis_servis' => $hb['jenis_servis'],
                'harga' => $hb['harga'],
                'status' => $hb['status'],
                'status_bayar' => $hb['status_bayar'],
                'tanggal_masuk' => $hb['tanggal_masuk'],
                'tanggal_selesai' => $hb['tanggal_selesai'],
                'created_at' => $hb['created_at'],
                'updated_at' => $hb['updated_at'],
            ]);

            DB::table('transaksi')->insert([
                'booking_id' => $bookingId,
                'total_bayar' => $hb['total_bayar'],
                'metode' => $hb['metode'],
                'status_bayar' => 'lunas',
                'catatan' => $hb['catatan'],
                'created_at' => $hb['created_at'],
                'updated_at' => $hb['updated_at'],
            ]);
        }

        // 2. Tambah data transaksi langsung (Walk-in / Offline)
        DB::table('transaksi_langsung')->insert([
            [
                'customer' => 'Joko',
                'no_hp' => '085299998888',
                'merk_kendaraan' => 'Toyota',
                'jenis_kendaraan' => 'Avanza',
                'jenis_servis' => 'Ganti Oli',
                'keluhan' => 'Ganti oli mesin berkala.',
                'harga' => 400000,
                'metode' => 'Cash',
                'status_bayar' => 'lunas',
                'created_at' => Carbon::now()->subMonths(5),
                'updated_at' => Carbon::now()->subMonths(5),
            ],
            [
                'customer' => 'Siti',
                'no_hp' => '085277776666',
                'merk_kendaraan' => 'Honda',
                'jenis_kendaraan' => 'Civic',
                'jenis_servis' => 'Service AC',
                'keluhan' => 'AC kurang dingin.',
                'harga' => 600000,
                'metode' => 'Transfer',
                'status_bayar' => 'lunas',
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subMonths(4),
            ],
            [
                'customer' => 'Rian',
                'no_hp' => '085255554444',
                'merk_kendaraan' => 'Suzuki',
                'jenis_kendaraan' => 'Ertiga',
                'jenis_servis' => 'Alternator',
                'keluhan' => 'Aki drop terus.',
                'harga' => 450000,
                'metode' => 'Cash',
                'status_bayar' => 'lunas',
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(3),
            ],
            [
                'customer' => 'Agus',
                'no_hp' => '085233332222',
                'merk_kendaraan' => 'Mitsubishi',
                'jenis_kendaraan' => 'Pajero',
                'jenis_servis' => 'Kelistrikan',
                'keluhan' => 'Sensor parkir mati.',
                'harga' => 300000,
                'metode' => 'Transfer',
                'status_bayar' => 'lunas',
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'customer' => 'Mega',
                'no_hp' => '085211110000',
                'merk_kendaraan' => 'Daihatsu',
                'jenis_kendaraan' => 'Xenia',
                'jenis_servis' => 'Tune Up',
                'keluhan' => 'Mesin agak pincang.',
                'harga' => 250000,
                'metode' => 'Cash',
                'status_bayar' => 'lunas',
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subMonths(1),
            ],
        ]);
    }
}
