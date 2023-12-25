<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('due_date');
            $table->integer('amount');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('refunded')->default(0);
            $table->string('serial')->nullable();
            $table->string('payment_way')->nullable();
            $table->string('serial_series')->nullable();
            $table->integer('serial_number')->nullable();
            $table->text('transaction_id')->nullable();
            $table->string('discount')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tax_type_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('invoices');
    }
}
