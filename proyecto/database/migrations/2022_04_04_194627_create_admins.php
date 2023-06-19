<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->integer('estatus')->default(1); // 1. asistió | 2. no asistió
            $table->integer('perfil')->default(4);  // 1. pro  | 2. admin
            $table->integer('disponible')->default(1); // 1. disponible | 2. ocupado
            $table->integer('tareas')->default(0);
            $table->integer('pesos')->default(0);
            $table->integer('total')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->string('username')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('admins');
    }
}
