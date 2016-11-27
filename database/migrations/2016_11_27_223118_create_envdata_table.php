<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envdata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sensor_id');
            $table->string('data');
            $table->string('ip');
            $table->timestamps();

            $table->foreign('sensor_id')->references('id')->on('sensors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('envdata');
    }
}
