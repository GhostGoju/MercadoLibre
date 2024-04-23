<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{

	public function authorize()
	{
		return true;    																		//? SIEMPRE DEBE ESTAR EN TRUE PARA AUTORIZAR LOS REQUEST
	}


	public function rules()
	{
		return [
			'email' => ['required', 'email'],
			'password' => ['required', 'string'],
		];
	}
}
