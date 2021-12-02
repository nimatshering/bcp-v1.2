<?php

namespace App\Imports;

use App\Models\ClimateProjectedData;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class ClimateProjectedDataImport implements ToModel, WithHeadingRow, SkipsOnError
{
  use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $stationId;
    private $parameterId;
    private $modelId;
    private $scenerioId;

    public function __construct($sid,$pid,$mid,$scid)
    {
        $this->stationId = $sid;
        $this->parameterId = $pid;
        $this->modelId = $mid;
        $this->scenerioId = $scid;
        //dd($this->stationId);
    }
    public function model(array $row)
    {
        return new ClimateProjectedData([
            'station_id' => $this->stationId,//$row['station_id'],
            'data' => $row['data'],
            'parameter_id' => $this->parameterId,// $row['parameter_id'],
            'model_id' => $this->modelId,// $row['model_id'],
            'scenerio_id' => $this->scenerioId,// $row['scenerio_id'],
            'data_source' => $row['data_source'],
            'date_of_reading' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_reading']),
            'user_id' => Auth::user()->id,
        ]);
    }

     
}