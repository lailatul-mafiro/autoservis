<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (Customer)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kode identifikasi booking (dipakai di pencarian & relasi claim)
            $table->string('kode_booking')->nullable(); // Menampung 'kode_booking' dari BookingController
            $table->string('kode')->nullable();         // Cadangan penamaan 'kode' di ClaimGaransi & Laporan
            
            // Informasi Kendaraan & Keluhan
            $table->string('merek')->nullable();
            $table->string('tipe_kendaraan')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->text('keluhan')->nullable();
            
            // Detail Layanan / Servis
            $table->string('jenis_servis')->nullable();
            $table->decimal('harga', 12, 2)->default(0); // Dipakai untuk draf transaksi otomatis
            
            // Penjadwalan Waktu Booking
            $table->date('tanggal_booking')->nullable();
            $table->time('jam_booking')->nullable();
            
            // Alur Status Operasional Bengkel
            $table->enum('status', ['Pending', 'Diterima', 'Diproses', 'Selesai', 'Dibatalkan'])
                  ->default('Pending');
            $table->text('alasan_tolak')->nullable();
            
            // Keuangan & Pembayaran
            $table->string('status_bayar')->default('belum'); // 'belum', 'menunggu', 'lunas' dari TransaksiController
            $table->text('keterangan')->nullable();          // Catatan servis tambahan saat transaksi update
            
            // Manajemen Garansi (Dipakai di RiwayatController Admin)
            $table->date('tanggal_selesai')->nullable();
            $table->integer('garansi_hari')->default(10);     // Default garansi 10 hari jika kosong
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};