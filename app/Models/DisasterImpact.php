<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterImpact extends Model
{
    use HasFactory;
    public $guarded = ['created_at', 'updated_at'];

    //Many to One relationship betweem DisasterImpact and DisasterData
    public function disaster(){
        return $this->belongsTo(DisasterData::class);
    }

   public function dzongkhag()
    {
      return $this->belongsTo(Dzongkhag::class, 'dzongkhag_id');
    }
}
