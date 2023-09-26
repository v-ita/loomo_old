<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'stock_quantity',
        'status',
        'unit_price'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function currency()
	{
		return $this->belongsTo(Currency::class);
	}
}
