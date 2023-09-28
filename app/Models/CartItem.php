<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity'
    ];

    public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

    public function cartItemAble(): MorphTo
    {
        return $this->morphTo();
    }

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
