<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('service_id');
            $table->tinyInteger('adult');
            $table->tinyInteger('kids');
            $table->longText('message');
            $table->unsignedDecimal('unit_amount');
            $table->unsignedDecimal('total_amount');
            $table->unsignedDecimal('discounted_amount');
            $table->tinyInteger('future_plan');
            $table->date('booking_date');
            $table->integer('currency');
            $table->tinyInteger('coupon_applied');
            $table->tinyInteger('status');
            $table->integer('updated_by');
            $table->string('cancelled_reason')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
