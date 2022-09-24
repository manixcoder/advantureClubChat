<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visited_location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('destination_name')->nullable();
            $table->string('geo_location')->nullable();
            $table->longText('destination_address')->nullable();
            $table->string('dest_mobile')->nullable();
            $table->string('dest_website')->nullable();
            $table->longText('dest_description')->nullable();
            $table->enum('is_approved',['0','1','2'])->default(0)->comment("0 requested ,1 approved 2 decline	");
            $table->datetime('deleted_at')->nullable();
            $table->string('destination_type')->nullable();
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
        Schema::dropIfExists('visited_location');
    }
}
