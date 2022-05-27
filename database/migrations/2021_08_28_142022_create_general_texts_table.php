<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_texts', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();

            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('media_path')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_ar')->nullable();
             $table->string('email')->nullable();
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
        Schema::dropIfExists('general_texts');
    }
}
