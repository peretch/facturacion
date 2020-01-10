<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranjaDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franja_descuentos', function (Blueprint $table) {
            $table->integer('descuento_id')->unsigned();
            $table->foreign('descuento_id')->references('id')->on('descuentos');

            $table->integer('monto_minimo');
            $table->double('valor');
            $table->boolean('porcentual')->default(1);

            $table->primary(array('descuento_id', 'monto_minimo'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franja_descuentos');
    }
}
