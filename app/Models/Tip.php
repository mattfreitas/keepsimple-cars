<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tip extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'user_id',
        'title',
        'description',
        'is_for_all_versions',
    ];


    /**
     * Get the user owner of tip.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Load model from tip.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(Model::class);
    }
}
