<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('geo_location')->nullable();
            $table->enum('license_status',['0','1'])->default(1)->nullable();
            $table->string('cr_name')->nullable();
            $table->integer('cr_number')->nullable();
            $table->string('cr_copy')->nullable();
            $table->string('payment_mode')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->datetime('created_date')->nullable();
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
        Schema::dropIfExists('vendors_details');
    }
}
