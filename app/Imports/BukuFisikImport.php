<?php

namespace App\Imports;

use App\Models\Buku_Fisik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuFisikImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buku_Fisik([
            'judul_buku'    => $row['judul_buku'],
            'jenis_buku'    => $row['jenis_buku'],
            'penulis'       => $row['penulis'],
            'penerbit'      => $row['penerbit'],
            'tahun_terbit'  => $row['tahun_terbit'],
            'nomor_buku'    => $row['nomor_buku'],
            'status'        => $row['status'] ?? 'Tersedia', // Gunakan nilai default jika kolom tidak ada
            'cover_buku'    => $row['cover_buku'],
        ]);
    }
}
