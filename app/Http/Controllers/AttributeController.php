<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeRequest;
use App\Models\Attribute;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class AttributeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Attribute/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttributeRequest $request)
    {
        $validated = $request->validated();
        $attribute = new Attribute($validated);
        $attribute->createdBy()->associate(User::find(auth()->id()));

        $attribute->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
