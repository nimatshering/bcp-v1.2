<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linkcategory extends Model
{
    use HasFactory;
    public $guarded =['created_at', 'updated_at'];      
    // links
     public function links()
    {
      return $this->hasMany(Link::class, 'link_id');
    }
}
