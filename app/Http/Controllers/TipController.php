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
        return view('tips.create', [ 
            'vehicleTypes' => VehicleType::all(),
            'makes' => Make::all()
        ]);
    }

    /**
     * Store a new tip.
     * 
     * @param \App\Http\Requests\Tip\TipRequest  $request
     * @param \App\Models\Tip $tip
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(TipRequest $request, Tip $tip)
    {
        $tip->create($request->validated() + [
            'user_id' => auth()->user()->id,
        ]);

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
        return view('tips.edit', [
            'tip' => $tip,
            'makes' => Make::all(),
            'vehicleTypes' => VehicleType::all()
        ]);
    }

    /**
     * Updates a tip.
     * 
     * @param Tip $tip
     * @param CreateTipRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(TipRequest $request, Tip $tip)
    {
        $tip->update($request->validated() + [
            'user_id' => auth()->user()->id,
        ]);

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
