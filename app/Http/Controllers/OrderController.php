<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class OrderController extends Controller
{
    private function cart(){
        return Cart::where('created_by', auth()->id())->first();
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->cart()->itemsOrderable();
        return Inertia::render('Order/Create', [
            'canCreateOrder' => $this->cart()->isOrderable()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // Create order
        $order = new Order();
        $order->createdBy()->associate(User::find(auth()->id()));
        $order->save();

        $itemsOrderable = $this->cart()->itemsOrderable();
        foreach ($itemsOrderable as $item) {
            // Create order item
            $orderItem = new OrderItem([
                'quantity' => $item->quantity,
                'unit_price' => $item->cartItemAble->unit_price
            ]);

            $orderItem->orderItemAble()->associate($item->cartItemAble);
            $orderItem->createdBy()->associate(User::find(auth()->id()));
            $orderItem->order()->associate($order);
            
            $orderItem->save();

            // Delete cart item
            $item->delete();
        }

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
