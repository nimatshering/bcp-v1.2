<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['post_id', 'username','comment'];


     /*-----------------------------------------------------
    |Many-to-one Relationship - Comments has only one post
    |------------------------------------------------------
    */
     public function forumpost(){
        return $this->belongsTo('App\Models\Forum');
      }
}
