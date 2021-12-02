<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    use HasFactory;

    protected $table = 'dzongkhags';

    public $guarded =['created_at', 'updated_at'];

    /*-----------------------------------------------------
    |Relationship - Dzongkhag and Gewogs
    |------------------------------------------------------
    */
    public function gewogs()
    {
      return $this->hasMany(Gewog::class, 'gewog_id');
    }
}
