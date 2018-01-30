<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('entity_type', ['user', 'organisation', 'client']);
            $table->integer('entity_id');
            $table->integer('address_type_id')->unsigned();
            $table->string('state');
            $table->string('city');
            $table->string('zip_code');
            $table->string('street');
            $table->string('number');
            $table->timestamps();

            $table->foreign('address_type_id')->references('id')->on('object_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
