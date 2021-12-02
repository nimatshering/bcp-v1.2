<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csrcategory extends Model
{
    use HasFactory;
    public $fillable =['name','slug'];

    public function getPublishedAtAttribute($date){
      return Carbon::parse($date)->format('Y/m/d');
    }

      //sub category
     public function subcategories()
    {
      return $this->hasMany(Csrsubcategory::class, 'cat_id');
    }
}
