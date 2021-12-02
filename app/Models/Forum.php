<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    
    protected $fillable = ['category_id','user_id' ,'topic', 'summary','content'];

    /*-----------------------------------------------------
    |many-to-one Relationship - Form post has many comments
    |------------------------------------------------------
    */
    public function category()
    {
      return $this->belongsTo(Forumcategory::class, 'category_id');
    }

    /*-----------------------------------------------------
    |One-to-many Relationship - Form post has many comments
    |------------------------------------------------------
    */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'post_id')->latest();
    }
}
