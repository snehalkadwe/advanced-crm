<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all();
    }

    // Add custom headers
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phome',
            'Created At',
            'Updated At',
        ];
    }
}
