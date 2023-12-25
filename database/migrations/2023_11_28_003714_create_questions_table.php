<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->string('question');
            $table->text('description');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('showLanding')->default(0);
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('questions_categories');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
