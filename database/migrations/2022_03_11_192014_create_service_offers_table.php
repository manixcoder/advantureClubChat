<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id');
            $table->string('name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('discount_type', ['1', '2'])->default(1)->comment('1=>Amount, 2=> Percentage');
            $table->integer('discount_amount');
            $table->string('banner');
            $table->string('description')->nullable();
            $table->enum('status', ['0', '1'])->default(0);
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
        Schema::dropIfExists('service_offers');
    }
}
