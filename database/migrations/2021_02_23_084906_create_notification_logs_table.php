<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('notification_id')->nullable();
            $table->integer('number_sent_to')->nullable();
            $table->string('number_success')->nullable();
            $table->string('number_failure')->nullable();
            $table->string('number_modification')->nullable();
            $table->text('tokens_to_delete')->nullable();
            $table->text('tokens_to_modify')->nullable();
            $table->text('tokens_to_retry')->nullable();
            $table->text('tokens_with_errors')->nullable();
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('notification_logs');
    }
}
