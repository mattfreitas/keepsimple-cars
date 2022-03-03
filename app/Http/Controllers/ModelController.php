<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Illuminate\Http\Request;
use App\Http\Resources\ModelResource;

class ModelController extends Controller
{
    /**
     * Get model by ID.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model  $model
     * @return \App\Http\Resources\ModelResource
     */
    public function getModel(Request $request, Model $model)
    {
        return new ModelResource($model);
    }
}
