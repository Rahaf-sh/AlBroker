<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->nullable()->index();
            $table->unsignedBigInteger('target_id')->nullable()->index();
            $table->unsignedBigInteger('receiver_id')->nullable()->index();
            $table->integer('status')->default(0)->comment("0 Not Seen,1 Seen");
            $table->string('type')->default('notification')->comment("notification,chat,alert")->nullable();
            $table->string('item_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('owner_item_id')->nullable();
            $table->text('body_en')->nullable();
            $table->text('body_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('title_ar')->nullable();
            $table->longText('object_action')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
