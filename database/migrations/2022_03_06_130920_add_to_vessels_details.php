<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToVesselsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vessels', function (Blueprint $table) {
            
          $table->longText("year_of_bulid")->nullable();
          $table->longText("gross_tonnage")->nullable();
          $table->longText("net_tonnage")->nullable();
          $table->longText("dead_weight")->nullable();
          $table->longText("length")->nullable();
          $table->longText("beam")->nullable();
          $table->longText("depth")->nullable();
          $table->longText("owners")->nullable();
          $table->longText("operators")->nullable();



          
           








 






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
