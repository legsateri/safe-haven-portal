<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('organisation_id')->unsigned()->nullable();
            $table->integer('pet_application_id')->unsigned();  // new added
            $table->integer('pet_type_id')->unsigned();
            $table->string('name');
            $table->string('breed');
            $table->decimal('weight', 8, 2);
            $table->integer('age');
            $table->dateTime('reported')->nullable();
            $table->text('description');
            $table->boolean('microchipped');
            $table->string('microchip_id')->nullable();
            $table->boolean('vaccinations');
            $table->boolean('sprayed');
            $table->boolean('objection_to_spray');
            $table->text('dietary_needs');
            $table->text('vet_needs');
            $table->text('temperament');
            $table->text('aditional_info');

            // new start
            $table->boolean('abuser_visiting_access');
            $table->text('estimated_lenght_of_housing');
            $table->boolean('pet_protective_order');
            $table->boolean('client_legal_owner_of_pet');
            $table->boolean('abuser_legal_owner_of_pet');   
            // $table->boolean('explored_boarding_options');
            // new end

            $table->dateTime('released_at')->nullable();
            $table->dateTime('relinguished_at')->nullable();
            $table->boolean('completed')->nullable();
            // $table->integer('release_status_id')->unsigned()->nullable();
            $table->string('slug');

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('pet_type_id')->references('id')->on('object_types');
            // $table->foreign('release_status_id')->references('id')->on('statuses');
            $table->foreign('pet_application_id')->references('id')->on('application_pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
