<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Make;
use App\Models\Model;
use App\Models\User;
use App\Models\VehicleType;
use App\Repositories\TipRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \App\Models\Model $model
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Model $model)
    {
        return view('home', [
            'makes' => Make::all(),
            'vehicleTypes' => VehicleType::all(),
            'tips' => TipRepository::getTipWithAdditionalData(
                make: $request->get('make', null),
                vehicle_type: $request->get('vehicle_type', null),
                model: $request->get('model', null),
            )->paginate(10)
        ]);
    }
}
