<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('entity_type', ['user', 'organisation', 'client']);
            $table->integer('entity_id');
            $table->integer('phone_type_id')->unsigned();
            $table->string('number')->nullable();
            $table->timestamps();

            $table->foreign('phone_type_id')->references('id')->on('object_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
