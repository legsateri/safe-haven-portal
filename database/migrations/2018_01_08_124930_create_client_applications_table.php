<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('status');

            $table->text('abuser_visiting_spots');
            $table->text('estimated_lenght_of_housing');

            $table->boolean('police_involved');
            $table->boolean('protective_order');
            $table->boolean('pet_protective_order');

            $table->boolean('client_legal_owner_of_pet');
            $table->boolean('abuser_legal_owner_of_pet');

            $table->boolean('explored_boarding_options');

            $table->text('abuser_notes');

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_applications');
    }
}
