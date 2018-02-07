<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_pet_id')->unsigned();
            $table->integer('pet_id')->unsigned();
            $table->integer('shelter_organisation_id')->unsigned();
            $table->text('title');
            $table->timestamps();

            $table->foreign('application_pet_id')->references('id')->on('application_pets');
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('shelter_organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_conversations');
    }
}
