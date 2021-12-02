<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forumcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /*-----------------------------------------------------
    |Relationship - Forumcategory to form topic
    |------------------------------------------------------
    */
    public function topics()
    {
      return $this->hasMany(Forum::class, 'category_id');
    }
}
