<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('start_datetime')->nullable();
            $table->string('end_datetime')->nullable();
            $table->enum('status',['1','0'])->default(1);
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
        Schema::dropIfExists('service_programs');
    }
}
