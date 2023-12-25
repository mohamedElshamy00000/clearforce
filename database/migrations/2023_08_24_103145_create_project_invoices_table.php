<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('amount');
            $table->string('desc');
            $table->string('invoice_type')->comment('1 = payed invoice | 2 = Request to clearforce');
            $table->date('due_date')->nullable();
            $table->string('unpaid_invoice_file')->nullable();
            $table->string('payment_proof_file')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('client_payment_status')->nullable()->default(null);
            $table->uuid('project_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('project_invoices');
    }
}
