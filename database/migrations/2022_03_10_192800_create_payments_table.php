<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('service_id');
            $table->integer('booking_id');
            $table->string('payment_method')->nullable();
            $table->string('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->dateTime('transaction_date');
            $table->string('account_name')->nullable();
            $table->enum('status',['0','1','2'])->default(0)->comment('1=Success,2=Failed');
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
        Schema::dropIfExists('payments');
    }
}
