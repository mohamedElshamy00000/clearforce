<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHsCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hs_codes', function (Blueprint $table) {
            $table->id();
            $table->string('hs_code')->nullable();
            $table->text('item_ar')->nullable();
            $table->text('item_en')->nullable();
            $table->string('duty')->nullable();
            $table->string('procedures')->nullable();
            $table->string('specific_Details')->nullable();
            $table->string('effective_date')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
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
        Schema::dropIfExists('hs_codes');
    }
}
