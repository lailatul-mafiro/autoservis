<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimGaransi extends Model
{
    use HasFactory;

    protected $table = 'claim_garansi';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'booking_id',
        'keluhan',
        'status',
        'catatan_admin',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}