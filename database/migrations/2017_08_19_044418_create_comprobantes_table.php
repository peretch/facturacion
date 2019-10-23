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
            $table->string('serie')->nullable();
            $table->integer('numero')->nullable();            

            $table->string('nombreCliente')->nullable();
            $table->string('direccion')->nullable();            
            $table->string('rut')->nullable();

            // Tipo comprobante
            $table->integer('tipo_comprobante_id')->unsigned();
            $table->foreign('tipo_comprobante_id')->references('id')->on('tipo_comprobantes');

            $table->double('subTotal')->default(0);
            $table->double('impuestos')->default(0);
            $table->double('total')->default(0);
            
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->integer('moneda_id')->unsigned()->nullable();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->double('cotizacion')->default(1);

            $table->date('fechaEmision');

            $table->softDeletes();
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
        Schema::dropIfExists('comprobantes');
    }
}
