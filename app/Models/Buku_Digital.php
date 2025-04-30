<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku_Digital extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'jenis_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis',
        'file_buku',
        'cover_buku',
    ];
}
