<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEndRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_end_requests', function (Blueprint $table) {
            $table->id();
            $table->string('file_name'); // صورة الفاتورة
            $table->string('restrictions')->nullable(); // قيود
            $table->unsignedTinyInteger('status')->default(0); // حالة التخليص
            $table->unsignedTinyInteger('transport')->default(0); // حالة النقل
            $table->uuid('project_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('project_end_requests');
    }
}
