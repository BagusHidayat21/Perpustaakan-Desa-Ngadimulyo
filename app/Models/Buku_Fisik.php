<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku_Fisik extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_buku',
        'jenis_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'nomor_buku',
        'status',
        'cover_buku',
    ];
}
