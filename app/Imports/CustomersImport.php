<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection()
    {
        return new Customer([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
        ]);
    }
}
