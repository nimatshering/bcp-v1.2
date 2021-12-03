<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Programproject extends Model
{
    use HasFactory;
    
    public $guarded =['created_at', 'updated_at'];
    
      // Published at date getter
        public function getPublishedAtAttribute($date)
        {
          return Carbon::parse($date)->format('Y-m-d');
        }

        // Get Start at date
        public function getStartAtAttribute($date)
        {
          return Carbon::parse($date)->format('Y-m-d');
        }

         // Get End at date
        public function getEndAtAttribute($date)
        {
          return Carbon::parse($date)->format('Y-m-d');
        }


        //Relationship
        public function documents()
        {
          return $this->hasMany(Projectdocument::class, 'project_id');
        }

}
