<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA LAPORAN (ONLINE + WALK-IN)
        |--------------------------------------------------------------------------
        */

        $dataOnline = DB::table('transaksi')
            ->join('bookings', 'transaksi.booking_id', '=', 'bookings.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'transaksi.created_at',
                'bookings.kode',
                'users.name as customer',
                'bookings.jenis_servis',
                'transaksi.total_bayar as total'
            )
            ->where('transaksi.status_bayar', 'Lunas')
            ->get();

        $dataWalkin = DB::table('transaksi_langsung')
            ->select(
                'created_at',
                DB::raw("'WALK-IN' as kode"),
                'customer',
                'jenis_servis',
                'harga as total'
            )
            ->where('status_bayar', 'lunas')
            ->get();

        $data = $dataOnline
            ->concat($dataWalkin)
            ->sortByDesc('created_at');

        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAPATAN
        |--------------------------------------------------------------------------
        */

        $totalOnline = DB::table('transaksi')
            ->where('status_bayar', 'Lunas')
            ->sum('total_bayar');

        $totalWalkin = DB::table('transaksi_langsung')
            ->where('status_bayar', 'lunas')
            ->sum('harga');

        $totalPendapatan = $totalOnline + $totalWalkin;

        /*
        |--------------------------------------------------------------------------
        | JUMLAH TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $jumlahTransaksi =
            DB::table('transaksi')
                ->where('status_bayar', 'Lunas')
                ->count()

            +

            DB::table('transaksi_langsung')
                ->where('status_bayar', 'lunas')
                ->count();

        /*
        |--------------------------------------------------------------------------
        | GRAFIK BULANAN (ONLINE + WALK-IN)
        |--------------------------------------------------------------------------
        */

        $grafikOnline = DB::table('transaksi')
            ->selectRaw('MONTH(created_at) as bulan, SUM(total_bayar) as total')
            ->where('status_bayar', 'Lunas')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

        $grafikWalkin = DB::table('transaksi_langsung')
            ->selectRaw('MONTH(created_at) as bulan, SUM(harga) as total')
            ->where('status_bayar', 'lunas')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'bulan')
            ->toArray();

        $grafik = [];

        for ($i = 1; $i <= 12; $i++) {
            $grafik[$i] =
                ($grafikOnline[$i] ?? 0)
                +
                ($grafikWalkin[$i] ?? 0);
        }

        /*
        |--------------------------------------------------------------------------
        | NAMA BULAN
        |--------------------------------------------------------------------------
        */

        $namaBulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // BAGIAN PALING BAWAH BERHASIL DIPERBAIKI
        return view('admin.laporan', compact(
            'data',
            'totalPendapatan',
            'jumlahTransaksi',
            'grafik',
            'namaBulan',
            'totalOnline',
            'totalWalkin'
        ));
    }
}