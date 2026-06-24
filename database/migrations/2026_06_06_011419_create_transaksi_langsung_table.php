<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_langsung', function (Blueprint $table) {
            $table->id();

            $table->string('customer');
            $table->string('no_hp')->nullable();

            $table->string('merk_kendaraan');
            $table->string('jenis_kendaraan');
            $table->string('jenis_servis')->nullable();

            $table->text('keluhan');

            $table->bigInteger('harga')->default(0);

            $table->enum('metode', ['Cash', 'Transfer'])
                  ->default('Cash');

            $table->enum('status_bayar', [
                'belum',
                'menunggu',
                'lunas'
            ])->default('lunas');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_langsung');
    }
};