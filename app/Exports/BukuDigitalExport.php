<?php

namespace App\Exports;

use App\Models\Buku_Digital;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BukuDigitalExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku_Digital::all();
    }

    public function headings(): array
    {
        return [
            [
                'Judul Buku',
                'Jenis Buku',
                'Penulis',
                'Penerbit',
                'Tahun Terbit',
                'Sinopsis',
                'File Buku',
                'Cover Buku',
                'Jumlah Dibaca',
                'Buku Favorit',
            ],
        ];
    }

    public function map($bukuDigital): array
    {
        return [
            $bukuDigital->judul_buku,
            $bukuDigital->jenis_buku,
            $bukuDigital->penulis,
            $bukuDigital->penerbit,
            $bukuDigital->tahun_terbit,
            $bukuDigital->sinopsis,
            $bukuDigital->file_buku,
            $bukuDigital->cover_buku,
            $bukuDigital->jumlah_dibaca ?? 0, // default ke 0 jika null
            $bukuDigital->buku_favorit ? 'Ya' : 'Tidak', // konversi ke Ya/Tidak
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Membuat heading (A1:L1) bold dan wrap text
        $sheet->getStyle('A1:L1')->getFont()->setBold(true);
        $sheet->getStyle('A1:L1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:L1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        return [];
    }
}
