<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File as FileSystem;

trait UploadFile
{
	private function uploadFile($model, $request) //? Trae el modelo y el request de un usuario/libro o categoria
	{
		if (!isset($request->file)) return; 															//? Se valida si existe el archivo
		$random = Str::random(20); 																		//? Si el archivo existe le da un nombre random para que no hayan duplicados
		$path = $this->getRoute($model); 																//? Este sale de las rutas (parte inferior del codigo)
		$this->deleteFile($model); 																		//? Se elmina el archivo se el libro ya tiene una imagen aosiada, para no almacenar todas las imagenes que se coloquen al libro (Public function deletefile)
		$imageName = "{$random}.{$request->file->clientExtension()}"; 									//? Trae el nombre random asignado y lo almacena en $imagenName
		$request->file->move(storage_path("app/public/{$path}"), $imageName);							//? Mueve la imagen a carpeta path
		$file = new File(['route' => "/storage/{$path}/{$imageName}"]);									//? Aqui construye toda la ruta almacenada con el nombre random asignado
		$model->file()->save($file);																	//? Esto envia el file al modelo para almacenar
	}

	private function deleteFile($model) 																//? Busca en la base de datos de file para retornar la imagen
	{
		$file = File::where('fileable_id', $model->id)
			->where('fileable_type', get_class($model))
			->first();
		if (!$file) return;
		$fileIsNotDefault = $file->route != "/storage/{$this->getRoute($model)}/default.png";			 //? Valida que no sea la imagen por defecto
		$issetFile = FileSystem::exists(public_path($file->route));
		if ($issetFile && $fileIsNotDefault) {
			FileSystem::delete(public_path($file->route)); 												//? Borra la imgen de la ruta
		}
		$file->delete();
	}

	private function getRoute($model) 																	//? Genera rutas bases para los modelos
	{
		$routes = [
			Product::class => 'images/products',
			User::class => 'images/users'
		];
		return $routes[get_class($model)] ?? 'images'; 													//? De no encontrar ninguna ruta lo almacena dentro de img
	}
}
