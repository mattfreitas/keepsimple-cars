<?php

/**
 * In this repository we handle all the database operations
 * that need more powerful queries that eloquent itself can't handle alone.
 */

namespace App\Repositories;
use App\Models\Model;

class TipRepository {

    /**
     * Return tips with model, make and user data.
     * 
     * @param  int|null  $make
     * @param  int|null  $vehicleType
     * @param  int|null  $model
     * @param  int|null $user_id
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTipWithAdditionalData(int $make = null, int $vehicle_type = null, int $model = null, int $user_id = null)
    {
        $tips = Model::select([
            'tips.id',
            'models.name as model_name',
            'models.version as model_version',
            'tips.id as tip_id',
            'tips.title',
            'tips.description',
            'tips.created_at',
            'tips.is_for_all_versions',
            'users.name as user_name',
            'makes.name as make_name',
        ])
        ->leftJoin('makes', 'makes.id', '=', 'models.make_id')
        ->leftJoin('tips', 'tips.model_id', '=', 'models.id')
        ->whereNotNull('tips.id')
        ->when($make, function ($query) use ($make) {
            return $query->where('make_id', $make);
        })
        ->when($vehicle_type, function ($query) use ($vehicle_type) {
            return $query->where('vehicle_type_id', $vehicle_type);
        })
        ->when($model, function ($query) use ($model) {
            return $query->where('model_id', $model);
        })
        ->when($user_id, function($query) use($user_id) {
            return $query->where('tips.user_id', $user_id);
        })
        ->leftJoin('users', 'users.id', '=', 'tips.user_id')
        ->groupBy('tips.id')
        ->orderBy('tips.created_at', 'DESC');

        return $tips;
    }

}