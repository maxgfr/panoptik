<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->double('radius')->nullable();
            $table->double('time')->nullable();
            $table->double('source')->nullable();
            $table->integer('device_id')->unsigned()->index();
            $table->foreign('device_id')->references('id')->on('device')->onDelete('cascade');
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
        Schema::dropIfExists('data');
    }
}
