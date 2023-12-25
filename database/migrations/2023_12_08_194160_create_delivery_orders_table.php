<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->string('address');
            $table->string('deliver_to');
            $table->string('deliver_address');
            $table->string('description');
            $table->string('qty');
            $table->string('deliver_date');
            $table->string('deliver_time');
            $table->string('remarks');
            $table->foreignId('company_id')->constrained()->onUpdate('cascade');
            $table->uuid('project_id')->nullable()->constrained()->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade');
            $table->unsignedTinyInteger('status')->default(0)->comment('0=Waiting | 1=Loading | 2=On the way| 3=in warehouse ');
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
        Schema::dropIfExists('delivery_orders');
    }
}
