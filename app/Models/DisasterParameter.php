<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterParameter extends Model
{
    use HasFactory;

    public $guarded = ['created_at', 'updated_at'];
}
