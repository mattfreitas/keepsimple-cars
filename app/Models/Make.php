<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Make extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the models for the make.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models()
    {
        return $this->hasMany(Model::class);
    }
}
