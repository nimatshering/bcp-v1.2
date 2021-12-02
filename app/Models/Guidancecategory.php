<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidancecategory extends Model
{
    use HasFactory;
    
    public $guarded =['created_at', 'updated_at'];

    public function subcategory()
    {
      return $this->hasMany(Guidancedocumentcategory::class, 'cat_id');
    }

}
