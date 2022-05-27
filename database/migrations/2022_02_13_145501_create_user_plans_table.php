<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();

            $table->integer('working_status')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->boolean('is_active')->nullable();
            $table->longText('secure_code')->nullable();
            $table->boolean('secure_code_status')->default(1);
            $table->integer('payment_status')->default(0);
            $table->unsignedBigInteger('payment_brand_id')->nullable();
            $table->string('payment_brand_name')->default(0);
            $table->decimal('fee',16,2)->default(0);
            $table->longText('payment_details')->nullable();
            $table->longText('payment_response')->nullable();
            $table->longText('payment_code')->nullable();
            $table->longText('payment_message')->nullable();
            $table->decimal('price',16,2)->default(0);
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->unsignedBigInteger('plan_id')->nullable(true);
            $table->string('expire_at')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
            $table->foreign('payment_brand_id')->references('id')->on('payment_brands')->onDelete('cascade');
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
        Schema::dropIfExists('user_plans');
    }
}
