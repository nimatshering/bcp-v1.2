<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainingmaterial extends Model
{
    use HasFactory;
      public $guarded =['created_at', 'updated_at'];


        public function documents()
        {
          return $this->hasMany(Trainingdocument::class, 'training_id');
        }
}
