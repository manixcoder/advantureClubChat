<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocode_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('booking_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('promocode_id')->nullable();
            $table->string('promocode')->nullable();
            $table->enum('disc_type',['1','2'])->default(1)->comment('1=>Amount, 2=>Percentage	');
            $table->string('disc_amt')->nullable();
            $table->string('service_amt_befor_disc')->nullable();
            $table->string('service_amt_after_disc')->nullable();
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
        Schema::dropIfExists('promocode_users');
    }
}
