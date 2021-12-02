<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug', 'description','photo','start_at','end_at'];

    // date getter
    public function getStartAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    // date getter
    public function getEndAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}
