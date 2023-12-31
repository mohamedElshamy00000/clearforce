<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=PENDING | 1=APPROVED | 2=REJECTED ');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('wallets');
    }
}
