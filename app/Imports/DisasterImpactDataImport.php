<?php

namespace App\Imports;
use Auth;
use App\Models\DisasterImpact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class DisasterImpactDataImport implements ToModel, WithHeadingRow
{
  use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $disasterId;
    //private $parameterId;
    private $dzongkhagId;
    public function __construct($did, $dzid)
    {
        //dd($did);
        $this->disasterId = $did;
        //$this->parameterId = $pid;
        $this->dzongkhagId = $dzid;
        //dd($this->stationId);
    }
    public function model(array $row)
    {
        return new DisasterImpact([
            'disaster_id' => 1,//$this->disasterId,//row['disaster_id'],
            'parameter_id' => $row['parameter_id'],
            'dzongkhag_id' => 1,//$this->dzongkhagId,
            'value' => $row['value'],
            'description' => $row['description'],
            'user_id' =>  Auth::user()->id,
        ]);
    }
}
