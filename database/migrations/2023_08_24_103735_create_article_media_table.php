<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->string('file_size')->nullable();
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
        Schema::dropIfExists('article_media');
    }
}
