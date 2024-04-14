<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\Ucfirst;
use App\Casts\Slug;

class Product extends Model
{
    use HasFactory, SoftDeletes;

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	public function municipality()
	{
		return $this->belongsTo(Municipality::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function features() {
        return $this->belongsToMany(Feature::class, 'feature_products')->withPivot(['quantite']);
    }

	public function casts() {
		return [
			'display_img_url_list' => 'json',
			'images_url_list' => 'json',
			'type' => Ucfirst::class,
			'slug' => Slug::class
		];
	}
}
