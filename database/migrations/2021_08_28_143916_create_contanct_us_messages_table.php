<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContanctUsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contanct_us_messages', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id')->nullable();
            $table->string('sender_client_id')->nullable();
            $table->string('sender_replyer_id')->nullable();
            $table->longText('message')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->boolean('is_seen')->default(0);
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
        Schema::dropIfExists('contanct_us_messages');
    }
}
