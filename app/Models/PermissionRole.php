<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

    public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
