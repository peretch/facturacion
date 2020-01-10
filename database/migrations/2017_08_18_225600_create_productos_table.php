<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique()->nullable();
            $table->index('codigo');
            $table->string('codigo_de_barras')->nullable();
            $table->index('codigo_de_barras');
            
            $table->integer('familiaProducto_id')->unsigned()->default(1);
            $table->foreign('familiaProducto_id')->references('id')->on('familia_productos');

            // Tasa de IVA
            $table->integer('tasa_iva_id')->unsigned()->default(1);
            $table->foreign('tasa_iva_id')->references('id')->on('tasas_iva');

            $table->integer('stock')->default(0);
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->double('precio')->default(0);

            $table->integer('stock_minimo_valor')->default(0);
            $table->boolean('stock_minimo_notificar')->default(0);


            $table->softDeletes();
            $table->timestamps();

            $table->index(['codigo', 'codigo_de_barras', 'nombre']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
