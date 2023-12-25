<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_centers', function (Blueprint $table) {
            $table->id();
            $table->string('documents')->nullable();
            $table->string('note')->nullable();
            $table->string('number');
            $table->unsignedTinyInteger('status')->default(0);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('verification_centers');
    }
}
