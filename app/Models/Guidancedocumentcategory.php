<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidancedocumentcategory extends Model
{
    use HasFactory;

    public $guarded =['created_at', 'updated_at'];

     /*-----------------------------------------------------
    |Relationship - Guidance document category and documents
    |------------------------------------------------------
    */
    public function documents()
    {
      return $this->hasMany(Guidancedocument::class, 'category_id');
    }

     public function category()
    {
      return $this->belongsTo(Guidancecategory::class, 'cat_id');
    }
    
}
