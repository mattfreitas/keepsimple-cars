<?php

namespace App\Http\Controllers;

use App\Repositories\TipRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Return the index from account.
     */
    public function index()
    {
        $tips = TipRepository::getTipWithAdditionalData(null, null, null, auth()->id())->get();
        return view('account.index', compact('tips'));
    }
}
