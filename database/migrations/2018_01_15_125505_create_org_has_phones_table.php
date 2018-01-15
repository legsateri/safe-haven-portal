<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgHasPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_has_phones', function (Blueprint $table) {

            $table->integer('organisation_id')->unsigned();
            $table->integer('phone_id')->unsigned();

            $table->timestamps();

            $table->primary(array('organisation_id', 'phone_id'));
            $table->foreign('organisation_id')->references('organisation_id')->on('organisations');
            $table->foreign('phone_id')->references('phone_id')->on('phones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org_has_phones');
    }
}
