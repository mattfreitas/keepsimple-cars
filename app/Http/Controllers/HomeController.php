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
        $tips = TipRepository::getTipWithAdditionalData(
            $request->get('make', null),
            $request->get('vehicle_type', null),
            $request->get('model', null)
        )->paginate(10);
        

        $makes = Make::all();
        $vehicleTypes = VehicleType::all();
        return view('home', compact('tips', 'makes', 'vehicleTypes'));
    }
}
