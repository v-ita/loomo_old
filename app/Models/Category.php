<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'enabled'
    ];

    public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
