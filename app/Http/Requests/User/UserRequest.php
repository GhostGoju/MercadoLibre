<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}


	protected $rules = [
		'name' => ['required', 'string'],
		'last_name' => ['required', 'string'],
		'email' => ['required', 'email', 'unique:users,email'],
		'password' => ['confirmed', 'string', 'min:8', 'required'],
	];



	public function rules()
	{
		if ($this->method() == 'PUT') {
			$this->rules['email'] = ['required', 'email', 'unique:users,email,' . $this->user->id];
			$this->rules['password'] = ['nullable', 'confirmed', 'string', 'min:8'];
		}

		return $this->rules;
	}

	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe de ser valido',
		];
	}
}
