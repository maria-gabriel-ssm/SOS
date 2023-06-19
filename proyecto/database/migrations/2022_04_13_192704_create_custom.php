<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom', function (Blueprint $table) {
            $table->id();
            $table->string('custom')->nullable();
            $table->string('customcolor')->nullable();
            $table->string('custombackground')->nullable();
            $table->string('custommode')->nullable();
            $table->string('custommenu')->nullable();
            $table->string('customother')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
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
        Schema::dropIfExists('custom');
    }
}
