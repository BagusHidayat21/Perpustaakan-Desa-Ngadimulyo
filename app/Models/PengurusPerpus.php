<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusPerpus extends Model
{
    use HasFactory;

    // Tabel terkait (opsional jika nama tabel tidak jamak)
    protected $table = 'pengurus';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'instagram',
        'facebook',
    ];
}
