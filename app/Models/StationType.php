<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationType extends Model
{
    use HasFactory;
    protected $fillable =['name'];

    public function parameters(){
        return $this->belongsToMany(Parameters::class);
    }
}
