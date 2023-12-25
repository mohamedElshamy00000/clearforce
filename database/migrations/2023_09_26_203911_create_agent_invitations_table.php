<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(0);
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('agent_invitations');
    }
}
