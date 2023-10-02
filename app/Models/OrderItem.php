<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_price',
        'quantity'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function order()
	{
		return $this->belongsTo(Order::class);
	}

    public function orderItemAble(): MorphTo
    {
        return $this->morphTo();
    }
}
