<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_code',
        'symbol',
        'symbol_position',
        'enabled'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
