<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('telefono');
            $table->string('equipo');
            $table->integer('estado')->default(1); // 1. En curso | 2. Finalizada
            $table->unsignedBigInteger('id_tarea');
            $table->foreign('id_tarea')->references('id')->on('tareas');
            $table->unsignedBigInteger('id_area');
            $table->foreign('id_area')->references('id')->on('areas');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->foreign('id_admin')->references('id')->on('admins');
            $table->string('reporte')->nullable();
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
        Schema::dropIfExists('ordenes');
    }
}
