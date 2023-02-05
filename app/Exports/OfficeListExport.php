<?php

namespace App\Exports;

use App\Models\Office;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OfficeListExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Office::all();
    }

    public function map($offices): array
    {
        return [
            $offices->manageBy ? $offices->manageBy->first_name . ' ' . $offices->manageBy->last_name : 'No assign manager',
            $offices->name,
        ];
    }

    public function headings(): array
    {
        return [
            'Manage By',
            'Office Name',
        ];
    }
}
