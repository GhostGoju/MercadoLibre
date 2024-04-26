<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',
		'product_id',
		'quantity',
	];


	public function getTotalPriceAttribute()
	{
		return $this->quantity * $this->product->price;
	}

	public function getTotalItemsAttribute()
	{
		return $this->quantity;
	}



	public function user()
	{
		return $this->hasOne(User::class, 'user_id', 'id');
	}

	public function product()
	{
		return $this->hasMany(Product::class, 'product_id', 'id');
	}
}
