<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csrsubcategory extends Model
{
    use HasFactory;

    public $guarded =['created_at', 'updated_at'];

     /*-----------------------------------------------------
    |Relationship - subcategory and documents
    |------------------------------------------------------
    */
    public function documents()
    {
      return $this->hasMany(Csrdocument::class, 'subcategory_id');
    }

    /*-----------------------------------------------------
    |Relationship - Category and subcategory
    |------------------------------------------------------
    */
     public function category()
    {
      return $this->belongsTo(Csrcategory::class, 'cat_id');
    }
}
