<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claim_garansi', function (Blueprint $table) {
            $table->id();
            // Cukup simpan ID penghubung saja
            $table->unsignedBigInteger('booking_id'); 
            $table->unsignedBigInteger('user_id');    
            
            // Kolom spesifik untuk kebutuhan klaim
            $table->string('customer')->nullable();
            $table->string('kode')->nullable();
            $table->string('jenis_servis')->nullable();
            $table->text('keluhan');
            $table->string('status')->default('pending'); // pending, diterima, ditolak, selesai
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            // Opsional: Bagus untuk menjaga relasi data antar tabel agar sinkron
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_garansi');
    }
};