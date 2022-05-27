<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargo_type_id')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->decimal('stowage_factor',16,2)->nullable();
            $table->unsignedBigInteger('landing_port_country_id')->nullable();
            $table->string('publishe_status')->default('draft')->comment('draft:active');
            $table->string('type')->default('main')->comment('main:offer');
             $table->string('landing_port_name')->nullable();
            $table->unsignedBigInteger('discharging_port_country_id')->nullable();
            $table->string('discharging_port_name')->nullable();

            $table->string('lay_can_start_date')->nullable();
            $table->string('lay_can_canceling_date')->nullable();
            $table->boolean('try_vessel_date')->default(0);


            $table->unsignedBigInteger('loading_rate')->nullable();
            $table->string('loading_rate_unit')->nullable();

            $table->unsignedBigInteger('discharging_rate')->nullable();
            $table->string('discharging_unit')->nullable();

            $table->longText('additional_cargo_details')->nullable();
            $table->longText('special_requests')->nullable();
            $table->decimal('fright_idea',16,2)->nullable();
            $table->string('fright_idea_unit')->nullable();
            $table->string('working_status')->default('new');
            $table->string('offer_status')->default('no_response');
            $table->string('charter_file')->nullable();
            $table->string('operator_file')->nullable();
            $table->string('final_file')->nullable();
            $table->decimal('address_commission',16,2)->nullable();

            $table->foreign('cargo_type_id')->references('id')->on('cargo_types');


            $table->unsignedBigInteger('charterer_id') ->nullable();
            $table->unsignedBigInteger('cargo_type_details_id') ->nullable();
            $table->unsignedBigInteger('vessel_id')-> nullable();
            $table->unsignedBigInteger('operator_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('final_offer_id')->nullable();

             $table->string('cargo_status')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->foreign('charterer_id')->references('id')->on('users');
            $table->foreign('vessel_id')->references('id')->on('vessels');
            $table->foreign('operator_id')->references('id')->on('users');
            $table->foreign('cargo_type_details_id')->references('id')->on('cargo_type_details');
            $table->foreign('parent_id')->references('id')->on('cargos');
            $table->foreign('final_offer_id')->references('id')->on('cargos');

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
        Schema::dropIfExists('cargos');
    }
}
