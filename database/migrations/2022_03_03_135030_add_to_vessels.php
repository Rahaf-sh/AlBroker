<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToVessels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vessels', function (Blueprint $table) {
            $table->string('type')->default('type');
            $table->string('call_sign')->default('call_sign');
            $table->string('flag')->default('flag');
            $table->string('port_of_register')->default('port_of_register');
            $table->string('class_society')->default('class_society');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vessels', function (Blueprint $table) {
            //
        });
    }
}
