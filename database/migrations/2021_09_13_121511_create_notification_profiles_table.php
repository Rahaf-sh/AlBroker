<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_profiles', function (Blueprint $table) {
            $table->id();
             $table->string("follower_id")->nullable();
             $table->string("followed_id")->nullable();
             $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
       
             $table->boolean("enable_notification")->default(1);
            
        });  
        Schema::table('user_tokens', function (Blueprint $table) {
       
 
             $table->string("current_lang")->default("en");
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_profiles');
    }
}
