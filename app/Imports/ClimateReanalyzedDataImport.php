<?php

namespace App\Imports;

use App\Models\ClimateReanalyzedData;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class ClimateReanalyzedDataImport implements ToModel, WithHeadingRow
{
  use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ClimateReanalyzedData([
            'station_id' => $row['station_id'],
            'data' => $row['data'],
            'data_source' => $row['data_source'],
            'parameter_id' => $row['parameter_id'],
            'date_of_reading' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_reading']),
            'user_id' =>  Auth::user()->id,//$row['user_id'],
        ]);
    }
}
