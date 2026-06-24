<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Pastikan nama model sesuai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $hariIni = Carbon::today();

        // 1. Data Ringkasan Statistik Kartu Utama (Sisi Customer)
        $totalBooking = Booking::where('user_id', $userId)->count();
        $diproses = Booking::where('user_id', $userId)->where('status', 'Diproses')->count();
        $selesai = Booking::where('user_id', $userId)->where('status', 'Selesai')->count();

        // 2. LOGIKA SINKRONISASI OTOMATIS: Menghitung Nomor Urut Antrean Anda
        // Kita kumpulkan semua ID booking yang aktif hari ini (belum selesai) berurutan dari yang paling dulu masuk
        $antreanAktifIds = Booking::whereDate('tanggal_booking', $hariIni)
            ->whereIn('status', ['Pending', 'Diterima', 'Diproses'])
            ->orderBy('created_at', 'asc')
            ->pluck('id')
            ->toArray();

        // Cari tahu apakah user ini punya booking aktif hari ini
        $bookingUserHariIni = Booking::where('user_id', $userId)
            ->whereDate('tanggal_booking', $hariIni)
            ->whereIn('status', ['Pending', 'Diterima', 'Diproses'])
            ->orderBy('created_at', 'asc')
            ->first();

        $noAntrean = 0;
        if ($bookingUserHariIni) {
            // Cari tahu posisi indeks baris data user di dalam deretan antrean aktif keseluruhan
            $posisi = array_search($bookingUserHariIni->id, $antreanAktifIds);
            $noAntrean = ($posisi !== false) ? ($posisi + 1) : 0;
        }

        // 3. Mengambil Data Real-Time Seluruh Kendaraan yang Sedang Mengantre Hari Ini
        // Untuk memuat nama pelanggan, pastikan di Model Booking sudah ada relasi 'user'
        $antreanHariIni = Booking::with('user') 
            ->whereDate('tanggal_booking', $hariIni)
            ->whereIn('status', ['Diterima', 'Diproses'])
            ->orderBy('created_at', 'asc')
            ->take(5) // Tampilkan maksimal 5 kendaraan teratas di komponen kanan bawah
            ->get();

        return view('customer.dashboard', compact(
            'totalBooking', 
            'diproses', 
            'selesai', 
            'noAntrean', 
            'antreanHariIni'
        ));
    }
}