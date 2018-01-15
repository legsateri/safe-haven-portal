<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_phones', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('phone_id')->unsigned();

            $table->timestamps();

            $table->primary(array('user_id', 'phone_id'));
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('phone_id')->references('phone_id')->on('phones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_phones');
    }
}
