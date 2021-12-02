<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterData extends Model
{
    use HasFactory;

    protected $table = 'disaster_data';

    public $guarded = ['created_at', 'updated_at'];

    //one to many relation between DisasterData and DisasterImpact
    public function impacts(){
        return $this->hasMany(DisasterImpact::class, 'disaster_id');
    }
}
