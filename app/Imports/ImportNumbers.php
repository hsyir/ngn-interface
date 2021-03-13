<?php

namespace App\Imports;

use Hsy\Ngn\Models\Number;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportNumbers implements ToModel, WithHeadingRow,WithBatchInserts
{
    public function model(array $row)
    {
        return new Number([
            'pre_number' => $row['pre_number'],
            'mid_number' => $row['mid_number'],
            'number' => $row['number'],
            'price' => $row['price'],
            'status' => $row['status'],
            'category' => $row['category'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
