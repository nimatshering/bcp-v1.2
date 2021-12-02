<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Csrdocument extends Model
{
    use HasFactory;

    public $guarded =['created_at', 'updated_at'];

        // date getter
        public function getPublishedAtAttribute($date)
        {
          return Carbon::parse($date)->format('Y/m/d');
        }
}
