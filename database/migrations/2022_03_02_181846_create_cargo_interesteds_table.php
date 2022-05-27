q<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoInterestedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_interesteds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('interested_id')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('interester_id')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->unsignedBigInteger('vessel_id')->nullable();
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('vessel_id')->references('id')->on('vessels');
            $table->foreign('interested_id')->references('id')->on('users');
            $table->foreign('interester_id')->references('id')->on('users');
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
        Schema::dropIfExists('cargo_interesteds');
    }
}
