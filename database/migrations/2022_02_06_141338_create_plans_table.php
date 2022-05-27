<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->default(0);
            $table->text('media_path')->nullable();
            $table->integer('type')->nullable();
            $table->integer('period_per_month')->nullable();
            $table->string('name_ar')->nullable();
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->string('name_en')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('plans');
            $table->boolean('is_deleted')->default(0);
            $table->decimal('price',16,2)->default(0);
            $table->decimal('from_',16,2)->default(1);
            $table->decimal('to_',16,2)->default(5);
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
        Schema::dropIfExists('plans');
    }
}
