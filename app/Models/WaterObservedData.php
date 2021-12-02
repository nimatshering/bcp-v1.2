<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterObservedData extends Model
{
    use HasFactory;

    protected $table = 'water_observed_data';

    public $fillable =['station_id','data','parameter_id', 'date_of_reading', 'user_id'];
}
