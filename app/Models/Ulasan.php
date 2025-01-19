<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'konser_id',
        'user_id',
        'isi',
        'rating',
    ];

    public function konser()
    {
        return $this->belongsTo(Konser::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
