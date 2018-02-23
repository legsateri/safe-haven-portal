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
            $table->integer('org_type_id')->unsigned();
            $table->integer('org_status_id')->unsigned()->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->text('services')->nullable();
            // $table->boolean('have_office_hours')->nullable();
            $table->text('office_hours')->nullable();
            $table->text('website')->nullable();
            $table->text('geographic_area_served')->nullable();
            $table->string('slug');
            $table->string('tax_id')->unique()->nullable();

            $table->timestamps();

            $table->foreign('org_type_id')->references('id')->on('object_types');
            $table->foreign('org_status_id')->references('id')->on('statuses');
            $table->foreign('address_id')->references('id')->on('addresses');
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
