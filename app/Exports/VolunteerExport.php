<?php

namespace App\Exports;

use App\Models\Volunteer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class VolunteerExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

    public function collection()
    {
        return Volunteer::with('user')->get();
    }

    public function map($volunteer): array
    {
        return [
            $volunteer->id,
            $volunteer->user->firstname,
            $volunteer->user->lastname,
            $volunteer->user->telephone,
            $volunteer->user->email,
            $volunteer->birth,
            $volunteer->street,
            $volunteer->house_number,
            $volunteer->city,
            $volunteer->points,
            $volunteer->ice,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Imię',
            'Nazwisko',
            'Numer telefonu',
            'Adres email',
            'Data urodzenia',
            'Ulica',
            'Numer domu / mieszkania',
            'Miasto',
            'Numer ICE',
            'Ilość punktów',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $event->sheet->getStyle('A')->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]]);
                $event->sheet->getStyle('B:K')->applyFromArray(['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT]]);
            }
        ];
    }
}
