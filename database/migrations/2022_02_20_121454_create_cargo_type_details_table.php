<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTypeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_type_details', function (Blueprint $table) {
            $table->id();
            $table->string('unit')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->decimal('min_',16,2)->default(0);
            $table->decimal('max_',16,2)->default(999);
            $table->decimal('comission_',16,2)->default(0);
            $table->unsignedBigInteger('cargo_type_id');
            $table->foreign('cargo_type_id')->references('id')->on('cargo_types');

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
        Schema::dropIfExists('cargo_type_details');
    }
}
