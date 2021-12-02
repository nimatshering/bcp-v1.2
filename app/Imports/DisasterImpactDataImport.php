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
    public function model(array $row)
    {
        return new DisasterImpact([
            'disaster_id' => $row['disaster_id'],
            'parameter_id' => $row['parameter_id'],
            'value' => $row['value'],
            'description' => $row['description'],
            'user_id' =>  Auth::user()->id,
        ]);
    }
}
