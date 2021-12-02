<?php

namespace App\Imports;

use App\Models\GreenhouseGas;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class GHGDataImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GreenhouseGas([
            'sector_id' => $row['sector_id'],
            'year' => $row['year'],
             'data' => $row['data'],
            'data_source' => $row['data_source'],
            'user_id' => Auth::user()->id,
        ]);
    }
}
