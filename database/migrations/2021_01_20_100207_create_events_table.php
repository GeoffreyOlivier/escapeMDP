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
            $table->string('description');
            $table->dateTime('start_at');
            $table->dateTime('ending_at')->nullable();
            $table->integer('nb_people_max')->nullable();
            $table->boolean('need_subscribe')->default(false);
            $table->string('place');
            $table->string('address');
            $table->string('street');
            $table->string('town');
            $table->string('api_google_id')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('image')->nullable();
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
