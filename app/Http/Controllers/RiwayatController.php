<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    /**
     * Menampilkan riwayat servis customer.
     */
    public function customer()
    {
        $data = DB::table('bookings')
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        // Ambil semua claim garansi milik customer
        $claims = DB::table('claim_garansi')
            ->join('bookings', 'claim_garansi.booking_id', '=', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->select('claim_garansi.*')
            ->get()
            ->keyBy('booking_id');

        return view('customer.riwayat', compact('data', 'claims'));
    }

    /**
     * Menampilkan riwayat servis untuk admin.
     */
    public function admin()
    {
        $data = DB::table('bookings')
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'bookings.*',
                'users.name as customer'
            )
            ->where('bookings.status', 'selesai')
            ->orderBy('bookings.id', 'desc')
            ->get();

        // Ambil semua claim garansi
        $claims = DB::table('claim_garansi')
            ->get()
            ->keyBy('booking_id');

        // Statistik kartu dashboard
        $totalServis = $data->count();

        $garansiAktif = $data->filter(function ($item) {
            if (empty($item->tanggal_selesai)) {
                return false;
            }

            $batasGaransi = \Carbon\Carbon::parse($item->tanggal_selesai)
                ->addDays($item->garansi_hari ?? 10);

            return now()->lessThanOrEqualTo($batasGaransi);
        })->count();

        $garansiExpired = $data->filter(function ($item) {
            if (empty($item->tanggal_selesai)) {
                return false;
            }

            $batasGaransi = \Carbon\Carbon::parse($item->tanggal_selesai)
                ->addDays($item->garansi_hari ?? 10);

            return now()->greaterThan($batasGaransi);
        })->count();

        return view('admin.riwayat', compact(
            'data',
            'claims',
            'totalServis',
            'garansiAktif',
            'garansiExpired'
        ));
    }
}