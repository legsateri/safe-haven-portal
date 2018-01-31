<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->integer('pet_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('organisation_id')->unsigned();

            $table->text('abuser_visiting_spots');
            $table->text('estimated_lenght_of_housing');
            $table->boolean('pet_protective_order');
            $table->boolean('client_legal_owner_of_pet');
            $table->boolean('abuser_legal_owner_of_pet');   
            $table->boolean('explored_boarding_options');         

            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('application_pets');
    }
}
