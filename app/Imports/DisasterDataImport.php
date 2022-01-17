<?php

namespace App\Imports;
use Auth;
use App\Models\DisasterData;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class DisasterDataImport implements ToModel, WithHeadingRow, SkipsOnError
{
  use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $dzongkhagId;
    private $parameterId;
    public function __construct($did,$pid)
    {
        $this->dzongkhagId = $did;
        $this->parameterId = $pid;
        //dd($this->);
    }

    public function model(array $row)
    {

        return new DisasterData([
            'dzongkhag_id' => $this->dzongkhagId,
            'type_id' => $this->parameterId,
            'disaster_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['disaster_date']),
            //'report_link' => $row['report_link'],
            'data_source' => $row['data_source'],
            'remarks' => $row['remarks'],
            'user_id' =>  Auth::user()->id,
        ]);
    }
}
