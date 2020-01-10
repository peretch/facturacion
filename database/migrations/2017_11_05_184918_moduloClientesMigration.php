<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModuloClientesMigration extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clientes', function (Blueprint $table) {
			$table->string('telefono')->nullable();
			$table->string('documento')->nullable();
			$table->integer('tipo_documento')->unsigned()->nullable();
			$table->foreign('tipo_documento', 'cliente_tipo_documento')->references('id')->on('tipos_documento');
			$table->index(['documento']);
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
			$table->dropColumn('telefono');
			$table->dropColumn('documento');			
		});
	}
}
