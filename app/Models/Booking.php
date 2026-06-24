<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'kode',
        'customer',
        'jenis_servis',
        'status',
        'keterangan',
        'harga',
        'status_bayar',
        'metode_bayar',
        'bukti_bayar',
        'tanggal_masuk',
        'tanggal_selesai',
        'tanggal_bayar',
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'tanggal_bayar' => 'datetime',
        'harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}