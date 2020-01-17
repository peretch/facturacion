<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('codigo')->unique()->nullable();
            $table->string('nombre');
            $table->string('descripcion')->nullable();

            $table->integer('tasa_iva_id')->unsigned()->default(1);
            $table->foreign('tasa_iva_id')->references('id')->on('tasas_iva');
            
            $table->integer('stock')->default(0);

            $table->integer('stock_minimo_valor')->default(0);
            $table->boolean('stock_minimo_notificar')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['codigo', 'nombre']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
