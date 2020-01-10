<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->increments('id');

            // Tipo comprobante
            $table->integer('tipo_comprobante_id')->unsigned();
            $table->foreign('tipo_comprobante_id')->references('id')->on('tipo_comprobantes');

            // Moneda
            $table->integer('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->double('cotizacion')->default(1);

            // Cliente asociado
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            // Datos del comprobante
            $table->string('serie')->nullable();
            $table->integer('numero')->nullable();

            // Datos del cliente
            $table->string('nombre_cliente')->nullable();
            $table->string('direccion')->nullable();            
            $table->string('rut')->nullable();

            // Calculo final
            $table->double('subTotal')->default(0);
            $table->double('iva')->default(0);
            $table->double('total')->default(0);
            

            $table->datetime('fecha_emision');

            $table->softDeletes();
            $table->timestamps();

            $table->index(['fecha_emision']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comprobantes');
    }
}
