<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hotels extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 191)->unique();
            $table->string('name');
            $table->string('stars');
            $table->string('country');
            $table->string('company');
            $table->timestamps();
        });

        Schema::create('hotel_user', function (Blueprint $table) {
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('user_id');

            $table->primary(['hotel_id', 'user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('hotel_id')
                ->references('id')
                ->on('hoteles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoteles');
    }
}