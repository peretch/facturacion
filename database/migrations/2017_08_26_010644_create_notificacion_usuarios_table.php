<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('leido')->default(0);

            $table->integer('usuario_id')->unsigned();
            $table->integer('notificacion_id')->unsigned();
            
            $table->foreign('usuario_id', 'not_usr_usr_fk')->references('id')->on('users');
            $table->foreign('notificacion_id', 'not_usr_not_fk')->references('id')->on('notificaciones');
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
        Schema::dropIfExists('notificacion_usuarios');
    }
}
