<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk kebutuhan query Builder/Insert tabel transaksi

class BookingController extends Controller
{
    // Menampilkan halaman kelola booking di admin panel
    public function index(Request $request)
    {
        $query = Booking::with('user')->orderBy('created_at', 'desc');

        // Fitur Pencarian & Filter Status di Admin Panel
        if ($request->filled('cari')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->cari . '%');
            })->orWhere('kode_booking', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('status') && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10);
        return view('admin.booking.index', compact('bookings'));
    }

    // Fungsi Update Status oleh Admin yang otomatis membuat draf transaksi saat Selesai
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Diproses,Selesai,Dibatalkan'
        ]);

        $booking = Booking::findOrFail($id);

        $booking->status = $request->status;
        $booking->save();

        // Jika servis selesai otomatis buat transaksi
        if ($request->status == 'Selesai') {

            DB::table('transaksi')->updateOrInsert(
                [
                    'booking_id' => $booking->id
                ],
                [
                    'total_bayar' => $booking->harga ?? 0, // Mengamankan nilai jika properti harga null
                    'status_bayar' => 'menunggu',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->back()
            ->with('success', 'Status booking berhasil diperbarui.');
    }
}