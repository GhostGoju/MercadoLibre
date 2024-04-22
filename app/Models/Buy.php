<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lend extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',
		'product_id',
		'date_out',
		'date_in',
		'status'
	];



	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
}
