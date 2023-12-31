<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $me = User::find(auth()->id());
        return Inertia::render('Product/Create', [
            "currencies" => Currency::where('enabled', true)->get(),
            "categories" => Category::where('enabled', true)->get(),
            "stores" => $me->stores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = new Product($validated);

        $product->createdBy()->associate(User::find(auth()->id()));
        if (isset($validated['currency_id'])) {
			$currency = Currency::find($validated['currency_id']);
			$product->currency()->associate($currency);
		}
        if (isset($validated['category_id'])) {
			$category = Category::find($validated['category_id']);
			$product->category()->associate($category);
		}
        if (isset($validated['store_id'])) {
			$store = Store::find($validated['store_id']);
			$product->store()->associate($store);
		}

        $product->save();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
