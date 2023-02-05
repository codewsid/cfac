<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientListExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('role', 3)->select(['first_name', 'last_name', 'email', 'role'])->get();
    }

    public function map($clients): array
    {
        return [
            $clients->first_name,
            $clients->last_name,
            $clients->email,
            $clients->role = 'Client',
        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Role',
        ];
    }
}
