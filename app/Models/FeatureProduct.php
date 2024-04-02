<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeatureProduct extends Model
{
    use HasFactory, SoftDeletes;
            
	public function feature()
	{
		return $this->belongsTo(Feature::class); 
	}
	public function product()
	{
		return $this->belongsTo(Product::class); 
	}
}