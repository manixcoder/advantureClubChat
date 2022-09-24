<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBecomePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('become_partner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->longText('address')->nullable();
            $table->longText('location')->nullable();
            $table->longText('description')->nullable();
            $table->string('license')->nullable();
            $table->string('cr_name')->nullable();
            $table->string('cr_number')->nullable();
            $table->string('cr_copy')->nullable();
            $table->string('debit_card')->nullable();
            $table->string('visa_card')->nullable();
            $table->string('payon_arrival')->nullable();
            $table->string('paypal')->nullable();
            $table->string('bankname')->nullable();
            $table->string('account_holdername')->nullable();
            $table->string('account_number')->nullable();
            $table->enum('is_online',['0','1'])->default(1)->comment('1 Active , 0 Inactive');
            $table->enum('is_approved',['0','1'])->default(0)->comment('1 Active , 0 Inactive');
            $table->integer('packages_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('is_wiretransfer',['0','1'])->default(0)->comment('1 true , 0 false');
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
        Schema::dropIfExists('become_partner');
    }
}
