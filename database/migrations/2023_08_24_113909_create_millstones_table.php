<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMillstonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('millstones', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->uuid('project_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('project_millstone_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('millstones');
    }
}
