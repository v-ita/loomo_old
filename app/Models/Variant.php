<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_quantity',
        'status',
        'enabled'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
