<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use  HasApiTokens, HasFactory, Notifiable, SoftDeletes;


	//? ESTOS SON TODOS LOS DATO QUE VENDRAN DE FUERA

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password'
	];


	//? HIDDEN

	protected $hidden = [
		'password',
		'remember_token',
	];


	//? APPENDS

	protected $appends = ['full_name'];


	//? CAST

	protected $cast = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
	];


	//? ACCESOR

	function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}


	//? MUTADORES

	function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	function setRememberTokenAttribute()
	{
		$this->attributes['remember_token'] = Str::random(30);
	}
}
