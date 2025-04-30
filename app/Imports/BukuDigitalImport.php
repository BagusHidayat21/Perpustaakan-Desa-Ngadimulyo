<?php

namespace App\Imports;

use App\Models\Buku_Digital;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuDigitalImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buku_Digital([
            'judul_buku'    => $row['judul_buku'],
            'jenis_buku'    => $row['jenis_buku'],
            'penulis'       => $row['penulis'],
            'penerbit'      => $row['penerbit'],
            'tahun_terbit'  => $row['tahun_terbit'],
            'sinopsis'      => $row['sinopsis'],
            'file_buku'     => $row['file_buku'],
            'cover_buku'    => $row['cover_buku'],
        ]);
    }
}
