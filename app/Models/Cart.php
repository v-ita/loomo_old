<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

	/**
	 * Check if orderable cart items exists in cart
	 */
    public function isOrderable()
	{
		return count($this->itemsOrderable());
	}

    public function items()
	{
		return $this->hasMany(CartItem::class)->with('cartItemAble');
	}

	/**
	 * If product
	 * * check direct price
	 * If variant
	 * * check variant price
	 * * check product price + attributes price
	 */
    public function itemsOrderable()
	{
		$result = [];
		$items = $this->items;
		foreach ($items as $item) {
			if ($item->cartItemAble->unit_price || $item->cart_item_able_type == 'variant' && $item->cartItemAble->product->unit_price) {
				$result[] = $item;
			}
		}
		return $result;
	}

    public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
