<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMesagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_mesages', function (Blueprint $table) {
            $table->id();
            $table->string('report_type')->default('report_normal');
            $table->longText('message')->nullable();
            $table->string('on_model_name')->default('items');
            $table->string('on_model_id')->default('items');
            $table->string('from_model_name')->default('users');
            $table->string('from_model_id')->default('users');
            $table->integer('status')->default(0)->comment("0:new,1:readed");
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
        Schema::dropIfExists('report_mesages');
    }
}
