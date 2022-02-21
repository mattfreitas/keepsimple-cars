<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'user_id',
        'title',
        'description',
        'is_for_all_versions',
    ];
}
