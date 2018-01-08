<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('organisation_type_id')->unsigned();
            $table->integer('organisation_status_id')->unsigned();
            $table->string('code');
            $table->string('update_action');
            $table->string('phone');
            $table->string('email');
            $table->text('services');
            $table->text('office_hours');
            $table->text('website_url');
            $table->text('geographic_area_served');
            $table->string('slug');
            $table->string('tax_id');

            $table->timestamps();

            $table->foreign('organisation_type_id')->references('id')->on('organisation_types');
            $table->foreign('organisation_status_id')->references('id')->on('organisation_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
