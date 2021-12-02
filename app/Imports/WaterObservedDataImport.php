<?php

namespace App\Imports;

use App\Models\WaterObservedData;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class WaterObservedDataImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $stationId;
    private $parameterId;
    public function __construct($sid,$pid)
    {
        $this->stationId = $sid;
        $this->parameterId = $pid;
        //dd($this->stationId);
    }
    public function model(array $row)
    {
        return new WaterObservedData([
            'station_id' => $this->stationId,//$row['station_id'],
            'data' => $row['data'],
            'parameter_id' => $this->parameterId,//$row['parameter_id'],
            'date_of_reading' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_reading']),
            'user_id' => Auth::user()->id,
        ]);
        
    }
}
