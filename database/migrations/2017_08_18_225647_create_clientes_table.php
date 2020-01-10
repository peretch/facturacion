<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('nombre');
            $table->string('apellido')->nullable();

            $table->boolean('empresa')->default(0);
            $table->string('rut')->nullable();
            
            $table->string('mail')->nullable();
            $table->string('direccion')->nullable(); 
            
            $table->string('genero')->nullable(); 

            // Descuento asociado
            $table->integer('descuento_id')->unsigned()->nullable();
            $table->foreign('descuento_id')->references('id')->on('descuentos');

            // Plazo factura por defecto
            $table->integer('plazo_factura')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['mail', 'rut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
