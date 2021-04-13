<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_type_id')->nullable();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->unsignedBigInteger('art_id')->nullable();
            $table->foreign('art_id')->references('id')->on('cultural_journey')->onDelete('cascade');
            $table->timestamp('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
