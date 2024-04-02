<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;
            
	public function code()
	{
		return $this->belongsTo(Code::class); 
	}
	public function user()
	{
		return $this->belongsTo(User::class); 
	}
}