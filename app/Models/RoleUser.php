<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
