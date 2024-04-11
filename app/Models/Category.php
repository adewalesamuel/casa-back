<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\Slug;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function casts() {
        return [
            'slug' => Slug::class
        ];
    }
            
	public function category()
	{
		return $this->belongsTo(Category::class); 
	}

}