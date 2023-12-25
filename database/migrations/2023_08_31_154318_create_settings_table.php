<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            $table->string('productName')->nullable();
            $table->string('productDescription_ar')->nullable();
            $table->string('productDescription_en')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address_ar')->nullable();
            $table->string('address_en')->nullable();
            $table->string('footerQuote_ar')->nullable();
            $table->string('footerQuote_en')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();

            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_Addesss')->nullable();
            $table->string('mail_from_name')->nullable();
            
            $table->string('moyasar_api_key')->nullable();

            $table->string('s3_access_key')->nullable();
            $table->string('s3_secret_key')->nullable();
            $table->string('s3_sefault_key')->nullable();
            $table->string('s3_bucket')->nullable();
            
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
        Schema::dropIfExists('settings');
    }
}
