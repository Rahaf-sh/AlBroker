<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
          
            $table->string('imo')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('operator_name')->nullable();
            $table->string('main_image')->nullable();
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->foreign('operator_id')->references('id')->on('users');
            $table->integer('is_deleted')->default(0);

            $table->string('status')->default('pending');
  
            $table->longText('ship_over_view')->nullable();
             $table->longText('principal_dimemsions')->nullable();
            $table->longText('tonnage')->nullable();
            $table->longText('load_line_infomation')->nullable();
            $table->longText('hold_capacities_cbm_cft')->nullable();
          
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
        Schema::dropIfExists('vessels');
    }
}
