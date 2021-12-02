<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    public $guarded = ['created_at','updated_at'];

    public function Type(){
        return $this->belongsTo(StationType::class);
    }

    /*-----------------------------------------------------
    |Many-to-one Relationship -  Parameter - scenerio 
    |------------------------------------------------------
    */
     public function scenerio(){
        return $this->belongsTo(Scenerio::class);
    }
}
