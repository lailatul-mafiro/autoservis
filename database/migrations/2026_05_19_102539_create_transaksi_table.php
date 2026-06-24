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
        Schema::create('transaksi', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('booking_id');

            $table->decimal('total_bayar', 12, 2)->default(0);

            $table->enum('metode', [
                'Cash',
                'Transfer'
            ])->nullable();

            $table->enum('status_bayar', [
                'belum',
                'menunggu',
                'lunas',
                'ditolak'
            ])->default('belum');

            $table->string('bukti_pembayaran')->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->foreign('booking_id')
                  ->references('id')
                  ->on('bookings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};