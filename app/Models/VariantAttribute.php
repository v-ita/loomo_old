<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_price',
        'enabled'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function variant()
	{
		return $this->belongsTo(Variant::class);
	}

    public function attributeValue()
	{
		return $this->belongsTo(AttributeValue::class);
	}
}
