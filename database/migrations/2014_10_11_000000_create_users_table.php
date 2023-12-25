<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('country');
            $table->string('zipCode')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('supportTransfer')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('type')->default(1)->comment('0 = admin | 1 = client | 2 = agent ');
            $table->unsignedTinyInteger('project_payment_mode')->default(0)->comment('0 = Payment with every invoice | 1 = Payment after project completion');

            $table->unsignedTinyInteger('receive_email')->default(1);
            $table->unsignedTinyInteger('verification')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
