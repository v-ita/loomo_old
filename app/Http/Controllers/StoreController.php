<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class StoreController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Store/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $validated = $request->validated();

        $store = new Store($validated);
        $store->createdBy()->associate(User::find(auth()->id()));
        $store->save();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
