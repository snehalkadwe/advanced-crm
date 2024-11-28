<?php

namespace App\Imports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Sale([
            'customer_id' => $row[0], // Ensure the first column is customer_id
            'product_name' => $row[1],
            'amount' => $row[2],
        ]);
    }
}
