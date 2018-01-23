<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_type_id')->unsigned();
            $table->integer('organisation_id')->unsigned()->nullable();
            $table->string('activation_code')->nullable();
            $table->boolean('activated')->default(false);
            $table->boolean('banned')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('object_types');
            $table->foreign('organisation_id')->references('id')->on('organisations');
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
