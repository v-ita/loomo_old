<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WishlistItem extends Model
{
    use HasFactory;

    public function wishlist()
	{
		return $this->belongsTo(Wishlist::class);
	}

    public function wishlistItemAble(): MorphTo
    {
        return $this->morphTo('wl_item_able');
    }

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
