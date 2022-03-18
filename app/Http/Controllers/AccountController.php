<?php

namespace App\Http\Controllers;

use App\Repositories\TipRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Return the index from account.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.index', [
            'tips' => TipRepository::getTipWithAdditionalData(
                user_id: auth()->id()
            )->get()
        ]);
    }
}
