<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'make_id',
        'vehicle_type_id',
        'name',
        'version',
    ];

    /**
     * Get the type of the model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle_type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Get the make of the model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    /**
     * Get the tips of the model.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tips()
    {
        return $this->hasMany(Tip::class);
    }

    /**
     * Get all version by model ID.
     * 
     * @return Array
     */
    public function getAllVersionByModelId($model_id)
    {
        $modelIds = $this->getAvailableVersions($model_id);
        return $modelIds;
    }

    /**
     * Get versions of the model.
     * 
     * @return Eloquent\Collection
     */
    public function getAvailableVersions($model_id = false)
    {
        $self = $model_id ? $this->where('id', $model_id)->first() : $this;
        $make = $self->make_id;
        $vehicle_type_id = $self->vehicle_type_id;
        $name = $self->name;

        return $this->select([ 'id', 'version' ])->where([
            ['make_id', $make],
            ['vehicle_type_id', $vehicle_type_id],
            ['name', $name],
        ])->get();
    }

    /**
     * Returns if the model is for all versions. Please note that this function should be used
     * using the TipRepository class.
     * 
     * @return boolean
     */
    public function getVersionFormattedAttribute()
    {
        return $this->is_for_all_versions ? 'Todas as versões' : $this->model_version;
    }
}
