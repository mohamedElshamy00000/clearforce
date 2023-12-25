<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('country')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->foreignId('shiping_mode_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            
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
        Schema::dropIfExists('ports');
    }
}
