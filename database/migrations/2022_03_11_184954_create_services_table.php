<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('owner')->nullable();
            $table->string('adventure_name')->collation('utf8_bin')->nullable();
            $table->integer('country')->nullable();
            $table->integer('region')->nullable();
            $table->integer('service_sector')->collation('utf8_bin')->nullable();
            $table->integer('service_category')->nullable();
            $table->integer('service_type')->nullable();
            $table->integer('service_level')->nullable();
            $table->integer('duration')->nullable();
            $table->tinyInteger('available_seats')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->longText('write_information')->collation('utf8_bin')->nullable();
            $table->tinyInteger('service_plan')->nullable();
            $table->text('availability')->collation('utf8_bin')->nullable();
            $table->text('geo_location')->collation('utf8_bin')->nullable();
            $table->longText('specific_address')->collation('utf8_bin')->nullable();
            $table->string('cost_inc')->collation('utf8_bin')->nullable();
            $table->string('cost_exc')->collation('utf8_bin')->nullable();
            $table->string('currency')->collation('utf8_bin')->nullable();
            $table->string('points')->collation('utf8_bin')->nullable();
            $table->longText('pre_requisites')->collation('utf8_bin')->nullable();
            $table->longText('minimum_requirements')->collation('utf8_bin')->nullable();
            $table->longText('terms_conditions')->collation('utf8_bin')->nullable();
            $table->tinyInteger('recommended')->nullable();
            $table->tinyInteger('status')->collation('utf8_bin')->nullable();
            $table->string('image')->collation('utf8_bin')->nullable();
            $table->longText('descreption')->collation('utf8_bin')->nullable();
            $table->string('favourite_image')->collation('utf8_bin')->nullable();
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('services');
    }
}
