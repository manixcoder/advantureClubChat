<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('package_id')->nullable();
            $table->string('title')->nullable();
            $table->enum('detail_type',['0','1'])->default(0)->comment('0=Exclude,1=Include');
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
        Schema::dropIfExists('package_detail');
    }
}
