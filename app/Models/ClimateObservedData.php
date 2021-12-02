<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimateObservedData extends Model
{
    use HasFactory;
    
    protected $table = 'climate_observed_data';

    public $fillable =['data','parameter_id', 'date_of_reading', 'user_id','station_id'];
}
