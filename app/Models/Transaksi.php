<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

  
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'booking_id',
        'total_bayar',
        'metode',
        'status_bayar',
        'bukti_pembayaran',
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}