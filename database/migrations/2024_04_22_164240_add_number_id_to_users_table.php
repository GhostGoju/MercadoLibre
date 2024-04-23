<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			if (Schema::hasTable('users') && !schema::hasColumn('users', 'number_id')) {         //? VERIFICACION DE QUE EXISTE LA TABLA USUARIOS Y EL CAMBO NUMBER_ID
				$table->string('number_id')->after('id')->nullable();                                         //? SI NO EXISTE ENTONCES LE DECIMOS QUE LA QUEREMOS CREAR / SIMPRE DEBE SER DEFAULT O NULLABLE (para evitar problemas)
			}
		});
	}

	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			if (Schema::hasTable('users') && !schema::hasColumn('users', 'number_id')) {         //? EN CASO DE EXISTIR BORRA EL CAMPO CREADO (clonado)
				$table->dropColumn('number_id');
			}
		});
	}
};
