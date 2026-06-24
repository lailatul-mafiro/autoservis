<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * ADMIN - Menampilkan Semua Daftar Transaksi
     */
    public function index()
    {
        $data = DB::table('transaksi')
            ->join('bookings', 'transaksi.booking_id', '=', 'bookings.id')
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'transaksi.*',
                'bookings.kode',
                'bookings.jenis_servis',
                'bookings.harga',
                'bookings.created_at',
                'users.name as customer'
            )
            ->orderBy('transaksi.id', 'desc')
            ->get();

        return view('admin.transaksi', compact('data'));
    }

    /**
     * ADMIN - Tampilkan Form Transaksi Langsung (Offline)
     */
    public function transaksiLangsung()
    {
        return view('admin.transaksi_langsung');
    }

    /**
     * ADMIN - Simpan Transaksi Langsung (Offline)
     */
    public function storeTransaksiLangsung(Request $request)
    {
        DB::table('transaksi_langsung')->insert([
            'customer'         => $request->customer,
            'no_hp'            => $request->no_hp,
            'merk_kendaraan'   => $request->merk_kendaraan,
            'jenis_kendaraan'  => $request->jenis_kendaraan,
            'jenis_servis'     => $request->jenis_servis,
            'keluhan'          => $request->keluhan,
            'harga'            => $request->harga,
            'metode'           => $request->metode,
            'status_bayar'     => 'lunas',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return back()->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * ADMIN - Update Transaksi (Menyimpan Harga, Status, dan Catatan Servis)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required|numeric',
            'status_bayar' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        if ($transaksi) {
            // Update data di tabel bookings
            DB::table('bookings')
                ->where('id', $transaksi->booking_id)
                ->update([
                    'keterangan' => $request->keterangan,
                    'harga' => $request->harga,
                    'status_bayar' => $request->status_bayar,
                    'updated_at' => now()
                ]);
            
            // Update data di tabel transaksi
            DB::table('transaksi')
                ->where('id', $id)
                ->update([
                    'status_bayar' => $request->status_bayar,
                    'updated_at' => now()
                ]);
        }

        return back()->with('success', 'Data transaksi dan catatan servis berhasil diperbarui');
    }

    /**
     * ADMIN - Download Bukti Transfer Customer
     */
    public function downloadBukti($id)
    {
        $transaksi = DB::table('transaksi')->where('id', $id)->first();

        if (!$transaksi || !($transaksi->bukti_pembayaran ?? null)) {
            return back()->with('error', 'Bukti pembayaran tidak ditemukan');
        }

        $path = public_path('uploads/bukti/' . $transaksi->bukti_pembayaran);

        if (!file_exists($path)) {
            return back()->with('error', 'File fisik tidak ditemukan di server');
        }

        return response()->download($path);
    }

    /**
     * CUSTOMER - Proses Pembayaran (Cash / Transfer)
     * Otomatis mengupdate tabel transaksi dan bookings secara sinkron
     */
    public function bayar(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:bookings,id',
            'metode' => 'required|in:Cash,Transfer',
            'bukti'  => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $booking = DB::table('bookings')->where('id', $request->id)->where('user_id', auth()->id())->first();
        if (!$booking) { 
            abort(404); 
        }

        $fileName = null;

        // Jika memilih Transfer, wajib mengunggah file bukti
        if ($request->metode === 'Transfer') {
            if (!$request->hasFile('bukti')) {
                return back()->with('error', 'Silakan upload bukti transfer.');
            }

            $file = $request->file('bukti');
            
            if (!file_exists(public_path('uploads/bukti'))) {
                mkdir(public_path('uploads/bukti'), 0755, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti'), $fileName);
        }

        // Otomatisasi status bayar berdasarkan pilihan metode
        $statusBayar = $request->metode === 'Cash' ? 'lunas' : 'menunggu';

        // 1. Update atau Buat Baru data di tabel transaksi
        DB::table('transaksi')->updateOrInsert(
            ['booking_id' => $request->id],
            [
                'total_bayar'       => $booking->harga ?? 0,
                'metode'            => $request->metode,
                'status_bayar'      => $statusBayar,
                'bukti_pembayaran'  => $fileName,
                'updated_at'        => now()
            ]
        );

        // Memastikan kolom created_at terisi jika ini data transaksi baru
        $cekTransaksi = DB::table('transaksi')->where('booking_id', $request->id)->whereNull('created_at')->first();
        if ($cekTransaksi) {
            DB::table('transaksi')->where('booking_id', $request->id)->update(['created_at' => now()]);
        }

        // 2. Sinkronisasi status_bayar ke tabel bookings agar status di halaman user ikut berubah
        DB::table('bookings')
            ->where('id', $request->id)
            ->update([
                'status_bayar' => $statusBayar,
                'updated_at'   => now()
            ]);

        return back()->with('success', $request->metode === 'Cash' 
            ? 'Pembayaran cash berhasil. Status pembayaran otomatis Lunas.' 
            : 'Bukti transfer berhasil diupload. Status berubah menjadi Menunggu Verifikasi.'
        );
    }
}