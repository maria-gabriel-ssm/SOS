<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_dir');
            $table->integer('id_sub');
            $table->integer('id_dep');
            $table->string('cargo');
            $table->string('celular')->nullable();
            $table->string('nombre');
            $table->string('programa');
            $table->string('tipo');
            $table->string('feini');
            $table->string('fefin');
            $table->string('sede');
            $table->string('emision');
            $table->string('receptores');
            $table->string('participantes');
            $table->integer('grabar');
            $table->string('comentarios')->nullable();
            $table->integer('estado')->default(1); // 1. En curso | 2. Finalizada
            $table->string('link')->nullable();
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
        Schema::dropIfExists('conferencias');
    }
}
