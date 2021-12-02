<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greenhousegas extends Model
{
    use HasFactory;
    public $guarded = ['created_at','updated_at'];


      /*-----------------------------------------------------
    |Many-to-one Relationship - Comments has only one post
    |------------------------------------------------------
    */
     public function sectors(){
        return $this->belongsTo('App\Models\Sector');
      }
}
