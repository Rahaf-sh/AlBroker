<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVesselMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel_media', function (Blueprint $table) {
            $table->id();
            $table->string("media_path")->nullable();
            $table->string("media_type")->nullable();
            $table->unsignedBigInteger("vessel_id")->nullable();
            $table->foreign("vessel_id")->references('id')->on('vessels');
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
        Schema::dropIfExists('vessel_media');
    }
}
