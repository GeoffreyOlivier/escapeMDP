<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('ending_at')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('nb_people_max')->nullable();
            $table->string('need_subscribe')->nullable();
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->string('price_one')->nullable();
            $table->string('price_two')->nullable();
            $table->string('price_three')->nullable();
            $table->string('price_four')->nullable();
            $table->string('api_google_id')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('deprecated')->default(false);
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
        Schema::dropIfExists('events');
    }
}
