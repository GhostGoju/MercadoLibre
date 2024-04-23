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

	protected $appends = ['total_price'];

	protected $casts = [
		'quantity' => 'integer',
	];

	// Mutador para calcular el precio total del producto en el carrito
	public function getTotalPriceAttribute()
	{
		return $this->quantity * $this->product->price;
	}

	// Accesor para obtener el total de artículos en el carrito
	public function getTotalItemsAttribute()
	{
		return $this->quantity;
	}

	// Accesor para obtener la descripción formateada del producto
	public function getFormatDescriptionAttribute()
	{
		return ucfirst(strtolower($this->product->description));
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
