<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'konser_id',
        'rekening_id',
        'user_id',
        'jumlah_tiket',
        'total_harga',
        'status_pesanan',
        'bukti_bayar',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];

    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
