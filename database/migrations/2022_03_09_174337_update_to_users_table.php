<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('users_role')->after('id')->nullable()->comment = '1 = Admin, 2 = Merchant 3 = Users ';
            $table->string('profile_image')->after('users_role')->nullable();
            $table->string('height')->after('profile_image')->nullable();
            $table->string('weight')->after('height')->nullable();
            $table->string('country_id')->after('weight')->nullable();
            $table->string('city_id')->after('country_id')->nullable();
            $table->string('now_in')->after('city_id')->nullable();
            $table->string('mobile')->after('now_in')->nullable();
            $table->string('dob')->after('mobile')->nullable();
            $table->string('gender')->after('dob')->nullable();
            $table->string('language_id')->after('gender')->nullable();
            $table->string('currency_id')->after('language_id')->nullable();
            $table->string('app_notification')->after('currency_id')->nullable();
            $table->string('points')->after('app_notification')->nullable();
            $table->string('health_conditions')->after('points')->nullable();
            $table->string('health_conditions_id')->after('health_conditions')->nullable();
            $table->enum('status', ['1', '2', '0'])->after('health_conditions_id')->default(1)->comment = '1=Male, 2 = Female 0=Special ';
            $table->string('mobile_code')->after('status')->nullable();
            $table->string('added_from')->after('mobile_code')->nullable();
            $table->string('username')->after('added_from')->nullable();
            $table->dateTime('first_name')->after('username')->nullable();
            $table->longText('last_name')->after('first_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('users_role')->nullable();
            $table->dropColumn('profile_image')->nullable();
            $table->dropColumn('height')->nullable();
            $table->dropColumn('weight')->nullable();
            $table->dropColumn('country_id')->nullable();
            $table->dropColumn('city_id')->nullable();
            $table->dropColumn('now_in')->nullable();
            $table->dropColumn('mobile')->nullable();
            $table->dropColumn('dob')->nullable();
            $table->dropColumn('gender')->nullable();
            $table->dropColumn('language_id')->nullable();
            $table->dropColumn('currency_id')->nullable();
            $table->dropColumn('app_notification')->nullable();
            $table->dropColumn('points')->nullable();
            $table->dropColumn('health_conditions')->nullable();
            $table->dropColumn('health_conditions_id')->nullable();
            $table->dropColumn('status')->nullable();
            $table->dropColumn('mobile_code')->nullable();
            $table->dropColumn('added_from')->nullable();
            $table->dropColumn('username')->nullable();
            $table->dropColumn('first_name')->nullable();
            $table->dropColumn('last_name')->nullable();
        });
    }
}
