<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'enabled'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
