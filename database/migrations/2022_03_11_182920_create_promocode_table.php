<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocode', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('promocode_name')->nullable();
            $table->string('code')->nullable();
            $table->enum('status',['0','1'])->default(1)->nullable()->comment('0=>InActive,1=>Active');
            $table->enum('discount_type',['1','2'])->default(1)->nullable()->comment('1=>Amount, 2=>Percentage');
            $table->integer('discount_amount')->nullable();
            $table->integer('redeemed_count')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('promocode');
    }
}
