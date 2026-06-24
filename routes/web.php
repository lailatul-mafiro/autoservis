<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController; 
use App\Http\Controllers\LaporanController; // 1. IMPORT CONTROLLER LAPORAN BERHASIL DITAMBAHKAN
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $layanans = DB::table('layanan')->orderBy('id', 'desc')->get();
    return view('welcome', compact('layanans'));
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (LOGIN, REGISTER, LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| MIDDLEWARE AUTH (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DASHBOARD
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/admin/dashboard', function () {
        $bookings = DB::table('bookings')
            ->orderBy('id', 'desc')
            ->get();

        // Menghitung jumlah booking pending keseluruhan
        $bookingBaru = DB::table('bookings')
            ->where('status', 'pending')
            ->count();

        // Ambil data claim baru (menghitung dari tabel claim_garansi status pending)
        $claimBaru = DB::table('claim_garansi')
            ->where('status', 'pending')
            ->count();

        $totalNotifikasi = $bookingBaru + $claimBaru;

        // Limit 5 antrean pending terbaru
        $bookingTerbaru = DB::table('bookings')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'bookings',
            'bookingBaru',
            'claimBaru',
            'totalNotifikasi',
            'bookingTerbaru'
        ));
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN - MANAGEMENT BOOKING
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/admin/booking', function (Request $request) {
        $query = DB::table('bookings');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('customer', 'like', '%' . $request->search . '%')
                  ->orWhere('kode', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('id', 'desc')->get();
        return view('admin.booking', compact('bookings'));
    });

    Route::post('/admin/update-booking', function (Request $request) {
        $status = $request->status ?? 'pending';
        
        DB::table('bookings')->where('id', $request->id)->update([
            'keterangan' => $request->keterangan ?? null,
            'harga' => $request->harga ?? 0,
            'status' => $status,
            'status_bayar' => $request->status_bayar ?? 'belum',
            'tanggal_selesai' => $status == 'selesai' ? now() : null,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Data booking berhasil diupdate');
    });

    Route::get('/admin/booking/hapus/{id}', function ($id) {
        DB::table('bookings')->where('id', $id)->delete();
        return back()->with('success', 'Data booking berhasil dihapus');
    })->name('admin.booking.hapus');

    Route::post('/admin/verifikasi-booking', function (Request $request) {
        $status = $request->status ?? 'pending';

        $updateData = [
            'keterangan'    => $request->keterangan ?? null,
            'harga'        => $request->harga ?? 0,
            'status'       => $status,
            'status_bayar' => $request->status_bayar ?? 'belum',
            'updated_at'   => now(),
        ];

        if ($status == 'selesai') {
            $updateData['tanggal_selesai'] = now();
        } else {
            $updateData['tanggal_selesai'] = null;
        }

        DB::table('bookings')->where('id', $request->id)->update($updateData);

        // --- BAGIAN TENGAH YANG TAMBAHKAN SESUAI PERINTAH ---
        if ($status == 'selesai') {

            $booking = DB::table('bookings')
                ->where('id', $request->id)
                ->first();

            DB::table('transaksi')->updateOrInsert(
                [
                    'booking_id' => $booking->id
                ],
                [
                    'total_bayar' => $booking->harga ?? 0,
                    'metode' => null,
                    'status_bayar' => 'belum',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        return back()->with('success', 'Status booking berhasil diperbarui.');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN - TRANSAKSI & PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])
        ->name('admin.transaksi');

    Route::put('/admin/transaksi/{id}', [TransaksiController::class, 'update'])
        ->name('admin.transaksi.update');

    Route::post('/admin/verifikasi-pembayaran/{id}', function ($id) {
        DB::table('bookings')->where('id', $id)->update([
            'status_bayar' => 'lunas',
            'updated_at' => now()
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi');
    })->name('admin.verifikasi.pembayaran');

    Route::get('/admin/download-bukti/{id}', [TransaksiController::class, 'downloadBukti'])
        ->name('admin.download.bukti');

    Route::get('/admin/invoice/{id}', function ($id) {
        $data = DB::table('bookings')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }
        return view('admin.invoice', compact('data'));
    })->name('admin.invoice');

    // ROUTE BARU: Transaksi Langsung (Offline/Walk-in)
    Route::get('/admin/transaksi-langsung', [TransaksiController::class, 'transaksiLangsung'])
        ->name('admin.transaksi.langsung');

    Route::post('/admin/transaksi-langsung/store', [TransaksiController::class, 'storeTransaksiLangsung'])
        ->name('admin.transaksi.langsung.store');

    /*
    |--------------------------------------------------------------------------
    | ADMIN - MANAGEMENT PELANGGAN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/pelanggan', function (Request $request) {
        $query = DB::table('users')->where('role', 'customer');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->orderBy('id', 'desc')->get();
        return view('admin.pelanggan', compact('data'));
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN - MANAGEMENT LAYANAN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/layanan', function () {
        $data = DB::table('layanan')->orderBy('id', 'desc')->get();
        return view('admin.layanan', compact('data'));
    })->name('admin.layanan');

    Route::post('/admin/layanan/tambah', function (Request $request) {
        $request->validate(['nama' => 'required|string|max:255']);

        DB::table('layanan')->insert([
            'nama' => $request->nama,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Layanan berhasil ditambahkan');
    })->name('admin.layanan.tambah');

    Route::get('/admin/layanan/hapus/{id}', function ($id) {
        DB::table('layanan')->where('id', $id)->delete();
        return back()->with('success', 'Layanan berhasil dihapus');
    })->name('admin.layanan.hapus');

    /*
    |--------------------------------------------------------------------------
    | ADMIN - RIWAYAT SERVIS & CLAIM GARANSI
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/riwayat', function () {
        $bookings = DB::table('bookings')
            ->where('status', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get()
            ->map(function ($item) {
                $item->garansi_hari = 10;
                $item->garansi_sampai = !empty($item->tanggal_selesai) 
                    ? \Carbon\Carbon::parse($item->tanggal_selesai)->addDays(10) 
                    : null;
                return $item;
            });

        $claims = DB::table('claim_garansi')
            ->orderBy('id', 'desc')
            ->get()
            ->keyBy('booking_id');

        return view('admin.riwayat', [
            'bookings' => $bookings,
            'data'     => $bookings,
            'claims'   => $claims,
        ]);
    })->name('admin.riwayat');

    Route::post('/admin/claim-garansi/update/{id}', function (Request $request, $id) {
        DB::table('claim_garansi')->where('id', $id)->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'updated_at'    => now(),
        ]);

        return back()->with('success', 'Status claim garansi berhasil diperbarui.');
    })->name('admin.claim.garansi.update');

    Route::get('/admin/riwayat/export', function () {
        $data = DB::table('bookings')
            ->where('status', 'selesai')
            ->orderBy('tanggal_selesai', 'desc')
            ->get();

        $filename = 'riwayat_servis_' . date('Ymd_His') . '.xls';
        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'max-age=0',
        ];

        $callback = function () use ($data) {
            echo chr(239) . chr(187) . chr(191); // BOM UTF-8
            echo '<table border="1">';
            echo '<tr style="background-color:#1e3a8a; color:#ffffff; font-weight:bold; text-align:center;">';
            echo '<th>Kode</th><th>Customer</th><th>Layanan</th><th>Tanggal Selesai</th><th>Garansi</th><th>Berlaku Sampai</th><th>Status Garansi</th>';
            echo '</tr>';

            foreach ($data as $row) {
                $tanggalSelesai = $row->tanggal_selesai ? \Carbon\Carbon::parse($row->tanggal_selesai) : null;
                $berlakuSampai = $tanggalSelesai ? $tanggalSelesai->copy()->addDays(10) : null;
                $statusGaransi = ($berlakuSampai && now()->lte($berlakuSampai)) ? 'Aktif' : 'Expired';

                echo '<tr>';
                echo '<td>' . $row->kode . '</td>';
                echo '<td>' . $row->customer . '</td>';
                echo '<td>' . $row->jenis_servis . '</td>';
                echo '<td>' . ($tanggalSelesai ? $tanggalSelesai->format('d M Y') : '-') . '</td>';
                echo '<td>10 Hari</td>';
                echo '<td>' . ($berlakuSampai ? $berlakuSampai->format('d M Y') : '-') . '</td>';
                echo '<td>' . $statusGaransi . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        };

        return response()->stream($callback, 200, $headers);
    })->name('admin.riwayat.export');

    /*
    |--------------------------------------------------------------------------
    | ADMIN - PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/profile', function () {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN - LAPORAN KEUANGAN
    |--------------------------------------------------------------------------
    */
    // 2 & 3. BLOK LAMA DIHAPUS DAN DIGANTI MENGGUNAKAN CONTROLLER
    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan');


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER - DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/customer/dashboard', function () {
        $userId = auth()->id();

        $totalBooking = DB::table('bookings')->where('user_id', $userId)->count();

        $diproses = DB::table('bookings')
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'diterima', 'proses'])
            ->count();

        $selesai = DB::table('bookings')
            ->where('user_id', $userId)
            ->where('status', 'selesai')
            ->count();

        $bookingAktif = DB::table('bookings')
            ->where('user_id', $userId)
            ->where(function($q) {
                $q->whereIn('status', ['pending', 'diterima', 'proses'])
                  ->orWhere(function($s) {
                      $s->where('status', 'selesai')->where('status_bayar', 'belum');
                  });
            })
            ->latest()
            ->first();

        $antreanHariIni = DB::table('bookings')
            ->where(function($q) {
                $q->whereIn('status', ['pending', 'diterima', 'proses'])
                  ->orWhere(function($s) {
                      $s->where('status', 'selesai')->where('status_bayar', 'belum');
                  });
            })
            ->orderBy('created_at')
            ->get();

        $noAntrean = '00';
        if ($bookingAktif) {
            $nomor = 1;
            foreach ($antreanHariIni as $item) {
                if ($item->id == $bookingAktif->id) {
                    $noAntrean = str_pad($nomor, 2, '0', STR_PAD_LEFT);
                    break;
                }
                $nomor++;
            }
        }

        return view('customer.dashboard', compact('totalBooking', 'diproses', 'selesai', 'bookingAktif', 'antreanHariIni', 'noAntrean'));
    });

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER - BOOKING WORKFLOW
    |--------------------------------------------------------------------------
    */
    Route::get('/customer/booking', function () {
        $bookings = DB::table('bookings')->where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $layanan = DB::table('layanan')->orderBy('id', 'desc')->get();

        return view('customer.booking', compact('bookings', 'layanan'));
    })->name('customer.booking');

    Route::post('/customer/booking', function (Request $request) {
        try {
            $lastBooking = DB::table('bookings')->orderBy('id', 'desc')->first();
            $nextNumber = ($lastBooking && preg_match('/BK(\d+)/', $lastBooking->kode, $match)) ? (int)$match[1] + 1 : 1;
            $kode = 'BK' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            DB::table('bookings')->insert([
                'kode'            => $kode,
                'user_id'         => auth()->id(),
                'customer'        => auth()->user()->name,
                'jenis_servis'    => $request->jenis_servis,
                'merek'           => $request->merek,
                'tipe_kendaraan'  => $request->tipe_kendaraan,
                'plat_nomor'      => $request->plat_nomor,
                'keluhan'         => $request->keluhan,
                'status'          => 'pending',
                'keterangan'      => null,
                'harga'           => 0,
                'status_bayar'    => 'belum',
                'tanggal_booking' => $request->tanggal_booking,
                'jam_booking'     => $request->jam_booking,
                'tanggal_masuk'   => now(),
                'tanggal_selesai' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            return back()->with(
                'success',
                'Booking berhasil dikirim. Silakan menunggu konfirmasi admin untuk proses selanjutnya.'
            );
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    })->name('customer.booking.store');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER - PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    Route::get('/customer/pembayaran', function () {
        $bookings = DB::table('bookings')
            ->leftJoin('transaksi', 'bookings.id', '=', 'transaksi.booking_id')
            ->select(
                'bookings.*',
                'transaksi.metode',
                'transaksi.status_bayar as transaksi_status'
            )
            ->where('bookings.user_id', auth()->id())
            ->orderBy('bookings.id', 'desc')
            ->get();

        return view('customer.pembayaran', compact('bookings'));
    });

    Route::post('/customer/bayar', [TransaksiController::class, 'bayar'])->name('customer.bayar');

    Route::get('/customer/invoice/{id}', function ($id) {
        $data = DB::table('bookings')->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$data) { abort(404); }

        return view('customer.invoice', compact('data'));
    })->name('customer.invoice');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER - CLAIM GARANSI
    |--------------------------------------------------------------------------
    */
    Route::post('/customer/claim-garansi', function (Request $request) {
        $request->validate([
            'booking_id' => 'required',
            'keluhan'    => 'required'
        ]);

        $booking = DB::table('bookings')->where('id', $request->booking_id)->first();
        if (!$booking) {
            return back()->with('error', 'Data booking tidak ditemukan.');
        }

        DB::table('claim_garansi')->insert([
            'booking_id'   => $booking->id,
            'user_id'      => auth()->id(),
            'customer'     => auth()->user()->name,
            'kode'         => $booking->kode,
            'jenis_servis' => $booking->jenis_servis,
            'keluhan'      => $request->keluhan,
            'status'       => 'pending',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return back()->with('success', 'Claim garansi berhasil dikirim dan menunggu verifikasi admin.');
    })->name('customer.claim.garansi');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER - LAYANAN, RIWAYAT, PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/customer/layanan', function () {
        $data = DB::table('layanan')->orderBy('id', 'desc')->get();
        return view('customer.layanan', compact('data'));
    });

    // EDIT: Route customer riwayat sudah diperbarui sesuai instruksi Anda
    Route::get('/customer/riwayat', function () {
        $bookings = DB::table('bookings')
            ->where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        $claims = DB::table('claim_garansi')
            ->where('user_id', auth()->id())
            ->get()
            ->keyBy('booking_id');

        return view('customer.riwayat', compact(
            'bookings',
            'claims'
        ));
    });

    Route::get('/customer/profile', function () {
        $user = auth()->user();
        return view('customer.profile', compact('user'));
    });

    Route::post('/customer/profile/update', function (Request $request) {
        $data = [
            'name' => $request->name,
            'no_hp' => $request->no_hp
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFile);
            $data['foto'] = $namaFile;
        }

        DB::table('users')->where('id', auth()->id())->update($data);
        return back()->with('success', 'Profil berhasil diupdate');
    });

});