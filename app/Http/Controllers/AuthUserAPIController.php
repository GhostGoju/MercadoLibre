<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthUserAPIController extends Controller
{
	public function login(AuthRequest $request)											//?VALIDA LOS DATOS DEL USUARIOS Y LE ASIGNA UN TOKEN
	{
		$user = User::where('email', $request->email)->first();
		if (!$user) return response()->json($this->handlerMessage(401), 401);
		if (!Hash::check($request->password, $user->password)) {             			//? HASH ~ VALIDA LO QUE VIENE EN EL REQUEST Y LO QUE CONTIENE USUARIO (AMBAS DEBEN COINCIDIR)
			return response()->json($this->handlerMessage(401), 401);					//? TOADAS LAS VALIDACIONES VAN DIRIGIDAS AL ERROR
		}
		$token = $user->createToken('auth_token')->plainTextToken;                      //? DE LO CONTRARIO (SI ESTA CORRECTO) SUCEDE ESTO (LE CREA UN TOKEN AL USUARIO)
		$data = ['access_token' => $token];
		return response()->json($this->handlerMessage(200, $data), 200);
	}

	public function logout()                       //?BORRAR EL TOKEN DEL USUARIO
	{
		/** @var \App\Models\User\User $user */
		$user = Auth::user();
		$user->tokens()->delete();
		return response()->json([], 204);
	}

	public function profile()
	{
		return response()->json(['auth_user' => Auth::user()], 200);
	}

	private function handlerMessage($code, $data = null)			//? FUNCION PARA EL MANEJO DE MENSAJES DE ERRORES
	{
		switch ($code) {
			case 401:
				return ['login' => false, 'message' => 'Password or email not valid'];

			default:
				return ['login' => true, 'message' => 'Login successful', 'data' => $data];
		}
	}
}
