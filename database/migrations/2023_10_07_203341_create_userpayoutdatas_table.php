<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserpayoutdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userpayoutdatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('iban')->nullable();
            $table->string('country')->nullable();
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
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
        Schema::dropIfExists('userpayoutdatas');
    }
}
