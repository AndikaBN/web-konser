<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    use HasFactory;

    protected $table = 'konser';

    protected $fillable = [
        'category_id',
        'nama_konser',
        'tanggal_konser',
        'waktu_konser',
        'lokasi',
        'deskripsi',
        'harga_tiket',
        'jumlah_tiket',
        'promosi_diskon',
        'gambar_konser',
        'status_konser',
    ];

    protected $casts = [
        'tanggal_konser' => 'date',
        'waktu_konser' => 'datetime:H:i',
        'harga_tiket' => 'decimal:2',
        'jumlah_tiket' => 'integer',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
