<?php

namespace App\Imports;

use App\Models\House;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class HousesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new House([
            'name'     => $row[0],
            'price'    => $row[1],
            'bedrooms' => $row[2],
            'bathrooms' => $row[3],
            'storeys' => $row[4],
            'garages' => $row[5],
        ]);
    }
}
