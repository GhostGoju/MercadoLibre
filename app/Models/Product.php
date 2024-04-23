<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'category_id',
		'title',
		'stock',
		'description',
	];

	protected $appends = ['format_description'];

	public function formatDescription(): Attribute
	{
		return Attribute::make( 								//?ACCESOR
			get: function ($value, $attributes) {
				return Str::limit($attributes['description'], 80,  '...');
			},
		);
	}



	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
}
