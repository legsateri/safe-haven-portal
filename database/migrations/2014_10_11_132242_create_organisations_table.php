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
            $table->increments('organisation_id');
            $table->string('name');
            $table->integer('org_type_id')->unsigned();
            $table->integer('org_status_id')->unsigned();
            $table->integer('address_id')->unsigned()->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->text('services')->nullable();
            $table->text('office_hours')->nullable();
            $table->text('website')->nullable();
            $table->text('geographic_area_served')->nullable();
            $table->string('slug');
            $table->string('tax_id')->unique();

            $table->timestamps();

            $table->foreign('org_type_id')->references('org_type_id')->on('organisation_types');
            $table->foreign('org_status_id')->references('org_status_id')->on('organisation_statuses');
            $table->foreign('address_id')->references('address_id')->on('addresses');
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
