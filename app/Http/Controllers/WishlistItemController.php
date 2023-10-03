<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishlistItemRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class WishlistItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Wishlist/Item/Create', [
            'wishlists' => Wishlist::all(),
            'products' => Product::all(),
            'variants' => Variant::with('product')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWishlistItemRequest $request, Wishlist $wishlist)
    {
        $validated = $request->validated();
        $wishlistItem = new WishlistItem();
        
        $wishlistItem->wishlist()->associate($wishlist);
        $wishlistItem->createdBy()->associate(User::find(auth()->id()));
        if (isset($validated['product_id'])) {
            $product = Product::find($validated['product_id']);
            $wishlistItem->wishlistItemAble()->associate($product);
        } else if (isset($validated['variant_id'])) {
            $variant = Variant::find($validated['variant_id']);
            $wishlistItem->wishlistItemAble()->associate($variant);
        }

        $wishlistItem->save();
        return redirect()->route(RouteServiceProvider::HOME);
    }
}
