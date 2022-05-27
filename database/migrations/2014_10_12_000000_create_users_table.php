<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique()->nullable();
          
            $table->string('password')->nullable();
            $table->string('country_id')->nullable();
             $table->string('company_id_number')->nullable();
            $table->string('company_address')->nullable();
            $table->string('city_id')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->decimal('rate')->default(0);
            $table->decimal('points')->default(0);
              $table->string('account_status')->default('active');
            $table->string('account_type')->default('operator');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('current_lang')->default('en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
