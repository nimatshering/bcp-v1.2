<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programprojectcategory extends Model
{
    use HasFactory;
    
    public $guarded =['created_at', 'updated_at'];

     public function projects()
    {
      return $this->hasMany(Programproject::class, 'category_id');
    }
}
