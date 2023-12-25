<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectHscodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_hscodes', function (Blueprint $table) {
            $table->id();

            // $table->integer('hs_code_id')->unsigned();        
            // $table->foreign('hs_code_id')->references('id')->on('roles')->onDelete('cascade');

            // $table->uuid('project_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('hs_code_id');
            $table->foreign('hs_code_id')->references('id')->on('hs_codes');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');


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
        Schema::dropIfExists('project_hscodes');
    }
}
