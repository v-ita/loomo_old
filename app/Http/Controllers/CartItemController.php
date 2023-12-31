<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CartItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cart/Item/Create', [
            'carts' => Cart::all(),
            'products' => Product::all(),
            'variants' => Variant::with('product')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartItemRequest $request, Cart $cart)
    {
        $validated = $request->validated();
        $cartItem = new CartItem($validated);
        
        $cartItem->cart()->associate($cart);
        if (isset($validated['product_id'])) {
			$product = Product::find($validated['product_id']);
            $cartItem->cartItemAble()->associate($product);
		} else if (isset($validated['variant_id'])) {
			$variant = Variant::find($validated['variant_id']);
            $cartItem->cartItemAble()->associate($variant);
		}
        $cartItem->createdBy()->associate(User::find(auth()->id()));

        $cartItem->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
