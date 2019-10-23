<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenciasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preferencias', function (Blueprint $table) {			
			// Usuario asociado
			$table->integer('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('users');
			$table->primary('usuario_id');

			$table->string('estilo')->default(config('app.style'));       
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('preferencias');
	}
}
