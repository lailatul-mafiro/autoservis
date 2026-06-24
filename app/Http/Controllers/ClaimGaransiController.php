<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimGaransiController extends Controller
{
    /**
     * Menampilkan semua data claim garansi untuk admin.
     */
    public function index()
    {
        $data = DB::table('claim_garansi')
            ->join('bookings', 'claim_garansi.booking_id', '=', 'bookings.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'claim_garansi.*',
                'bookings.kode',
                'bookings.jenis_servis',
                'users.name as customer'
            )
            ->orderBy('claim_garansi.id', 'desc')
            ->get();

        return view('admin.claim_garansi', compact('data'));
    }

    /**
     * Menyimpan pengajuan claim garansi oleh customer.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'keluhan'    => 'required',
        ]);

        // Cek apakah booking sudah pernah diajukan claim
        $cek = DB::table('claim_garansi')
            ->where('booking_id', $request->booking_id)
            ->first();

        if ($cek) {
            return back()->with('error', 'Claim garansi sudah pernah diajukan.');
        }

        DB::table('claim_garansi')->insert([
            'booking_id'    => $request->booking_id,
            'keluhan'       => $request->keluhan,
            'status'        => 'Pending',
            'catatan_admin' => null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return back()->with('success', 'Claim garansi berhasil diajukan.');
    }

    /**
     * Menampilkan halaman claim untuk customer.
     */
    public function customer()
    {
        $data = DB::table('claim_garansi')
            ->join('bookings', 'claim_garansi.booking_id', '=', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->select(
                'claim_garansi.*',
                'bookings.kode',
                'bookings.jenis_servis'
            )
            ->orderBy('claim_garansi.id', 'desc')
            ->get();

        return view('customer.claim_garansi', compact('data'));
    }

    /**
     * Menampilkan detail claim.
     */
    public function show($id)
    {
        $data = DB::table('claim_garansi')
            ->join('bookings', 'claim_garansi.booking_id', '=', 'bookings.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'claim_garansi.*',
                'bookings.kode',
                'bookings.jenis_servis',
                'users.name as customer'
            )
            ->where('claim_garansi.id', $id)
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('admin.claim_detail', compact('data'));
    }

    /**
     * Update status claim oleh admin.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        DB::table('claim_garansi')
            ->where('id', $id)
            ->update([
                'status'        => $request->status,
                'catatan_admin' => $request->catatan_admin ?? null,
                'updated_at'    => now(),
            ]);

        return back()->with('success', 'Status claim garansi berhasil diperbarui.');
    }

    /**
     * Menghapus claim garansi.
     */
    public function destroy($id)
    {
        DB::table('claim_garansi')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Data claim garansi berhasil dihapus.');
    }
}