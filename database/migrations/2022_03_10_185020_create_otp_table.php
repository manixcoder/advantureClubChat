<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->enum('otp_on', ['1', '2'])->default(1)->comment('1 = Mobile , 2 = Email');
            $table->enum('type', ['1', '2', '3', '4'])->default(1)->comment('1=SignUp,2=Forgot Password,3=Login,4=ChnageMobileNumber');
            $table->string('email')->nullable();
            $table->string('mobile_code')->nullable();
            $table->bigInteger('mobile');
            $table->tinyInteger('otp');
            $table->enum('status', ['0', '1'])->default(0)->comment('1=Verified');
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
        Schema::dropIfExists('otp');
    }
}
