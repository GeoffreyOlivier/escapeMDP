<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('entreprise')->nullable();;
            $table->string('phone')->nullable();
            $table->boolean('promoter');
            $table->string('siret')->nullable();;
            $table->string('street')->nullable();
            $table->string('town');
            $table->string('code')->nullable();;
            $table->string('site')->nullable();
            $table->string('social')->nullable();
            $table->boolean('deprecated')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('selected')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
