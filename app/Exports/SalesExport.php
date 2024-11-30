<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Sale::with('customer')->get()->map(function ($sale) {
            // Retrieve all users and include the related role name using eager loading
            return [
                'ID' => $sale->id,
                'Customer Name' => $sale->customer->name,
                'Product Name' => $sale->email,
                'Amount' => $sale->amount,
                'Created At' => $sale->created_at,
                'Updated At' => $sale->updated_at,
            ];
        });
    }

    // Add custom headers
    public function headings(): array
    {
        return [
            'ID',
            'Customer ID',
            'Product Name',
            'Amount',
            'Created At',
            'Updated At',
        ];
    }
}
