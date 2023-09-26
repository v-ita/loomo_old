<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CurrencyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Currency/Create', [
            "symbolPosition" => [
                "left" => "Left",
                "right" => 'Right'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request)
    {
        $validated = $request->validated();

        $currency = new Currency($validated);
        $currency->createdBy()->associate(User::find(auth()->id()));
        $currency->save();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
