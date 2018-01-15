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
            $table->integer('pet_type_id')->unsigned();
            $table->string('name');
            $table->string('breed');
            $table->decimal('weight',  8, 2);
            $table->integer('age');
            $table->dateTime('reported');
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
            $table->dateTime('released_at');
            $table->dateTime('relinguished_at');
            $table->boolean('completed');
            $table->integer('realise_status_id')->unsigned()->nullable();
            $table->string('slug');

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('organisation_id')->references('organisation_id')->on('organisations');
            $table->foreign('pet_type_id')->references('id')->on('pet_types');
            $table->foreign('realise_status_id')->references('id')->on('realise_statuses');
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
