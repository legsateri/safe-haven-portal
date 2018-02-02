<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('organisation_id')->unsigned();
            $table->integer('created_by_advocate_id')->unsigned();
            $table->integer('status')->default(0);

            $table->boolean('police_involved');
            $table->boolean('protective_order');

            $table->text('abuser_notes');

            $table->integer('release_status_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('created_by_advocate_id')->references('id')->on('users');
            $table->foreign('release_status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
