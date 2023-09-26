<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVariantRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class VariantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $me = User::find(auth()->id());
        return Inertia::render('Variant/Create', [
            "products" => $me->products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantRequest $request, Product $product)
    {
        $validated = $request->validated();
        $variant = new Variant($validated);

        $variant->createdBy()->associate(User::find(auth()->id()));
        $variant->product()->associate($product);

        $variant->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
