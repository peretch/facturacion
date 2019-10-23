<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDocumentosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_documento', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tipo_documento');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clientes', function (Blueprint $table) {
			$table->dropForeign('cliente_tipo_documento');
			$table->dropColumn('tipo_documento');
		});
		Schema::dropIfExists('tipos_documento');
	}
}
