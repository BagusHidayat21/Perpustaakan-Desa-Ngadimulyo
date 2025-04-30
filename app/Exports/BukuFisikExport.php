<?php

namespace App\Exports;

use App\Models\Buku_Fisik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BukuFisikExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku_Fisik::all();
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
                'Nomor Buku',
                'Cover Buku',
                'Status Buku',
            ],
        ];
    }

    public function map($bukuFisik): array
    {
        return [
            $bukuFisik->judul_buku,
            $bukuFisik->jenis_buku,
            $bukuFisik->penulis,
            $bukuFisik->penerbit,
            $bukuFisik->tahun_terbit,
            $bukuFisik->nomor_buku,
            $bukuFisik->cover_buku,
            $bukuFisik->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Membuat heading (A1:H2) bold dan wrap text
        $sheet->getStyle('A1:H2')->getFont()->setBold(true);
        $sheet->getStyle('A1:H2')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:H2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:H2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        return [];
    }
}
