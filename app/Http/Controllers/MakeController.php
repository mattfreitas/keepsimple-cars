<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;
use App\Http\Resources\MakeResource;

class MakeController extends Controller
{
    /**
     * Returns a list of models by make id.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getModelsFromMake(Request $request, Make $make)
    {
        return new MakeResource($make);
    }
}
