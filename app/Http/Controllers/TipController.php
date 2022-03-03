<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tip\TipRequest;
use App\Models\Make;
use App\Models\Tip;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class TipController extends Controller
{
    /**
     * Check if the user is authenticated.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form to create a new tip.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $makes = Make::all();
        return view('tips.create', compact('makes', 'vehicleTypes'));
    }

    /**
     * Store a new tip.
     * 
     */
    public function store(TipRequest $request, Tip $tip)
    {
        $saveData = $request->only([
            'title',
            'description',
            'model_id',
            'is_for_all_versions',
        ]) + [
            'user_id' => auth()->user()->id,
        ];

        $tip->create($saveData);
        return redirect()->route('tips.create')->withMessage('Dica criada com sucesso! Você acaba de tornar a experiência de compra de carro melhor.');
    }

    /**
     * Edit a tip.
     * 
     * @param Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip)
    {
        $makes = Make::all();
        $vehicleTypes = VehicleType::all();
        return view('tips.edit', compact('tip', 'makes', 'vehicleTypes'));
    }

    /**
     * Updates a tip.
     * 
     * @param Tip $tip
     * @param CreateTipRequest $request
     */
    public function update(TipRequest $request, Tip $tip)
    {
        $saveData = $request->only([
            'title',
            'description',
            'model_id',
            'is_for_all_versions',
        ]) + [
            'user_id' => auth()->user()->id,
        ];

        $tip->update($saveData);
        return redirect()->route('tips.edit', $tip->id)->withMessage('Dica atualizada com sucesso!');
    }

    /**
     * Deletes a tip.
     * 
     * @param Tip $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();
        return redirect()->route('accounts.index')->withMessage('Dica excluída com sucesso!');
    }
}
