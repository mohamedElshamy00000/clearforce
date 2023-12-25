<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('type')->nullable();
            $table->string('Goodstype')->nullable();
            $table->unsignedTinyInteger('needShiping')->default(0);
            $table->string('truckType')->nullable();
            $table->string('deliveryPlace')->nullable();
            $table->unsignedBigInteger('countryTo');
            $table->unsignedBigInteger('countryFrom');
            $table->date('arrivalDate')->nullable();
            $table->string('Budget')->nullable();
            $table->string('note')->nullable();
            $table->string('Waybill')->nullable(); // رقم البوليصة
            
            $table->unsignedTinyInteger('status')->default(0)->comment('0 = new | 1 = accepted | 2 = Ongoing | 3 = Completed | 4 = rejected');
            $table->unsignedTinyInteger('payment_mode')->default(1)->comment('1 = Payment with every invoice | 2 = Payment after project completion');

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('port_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('shiping_mode_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hs_code_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('countryFrom')->references('id')->on('countries');
            $table->foreign('countryTo')->references('id')->on('countries');
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
        Schema::dropIfExists('projects');
    }
}
