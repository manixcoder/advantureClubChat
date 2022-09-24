<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $userData = array(
            array(
                'id' => 1,
                'users_role' => 1,
                'profile_image' => 'avatar-5.png',
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Qwert@123'),
                'height' => '',
                'weight' => '',
                'city_id' => '',
                'now_in' => '',
                'mobile' => '',
                'dob' => '1993-05-04',
                'gender' => 'male',
                'language_id' => '1',
                'currency_id' => '1',
                'app_notification' => '1',
                'points' => '0',
                'health_conditions' => '1',
                'health_conditions_id' => '1',
                'mobile_code' => '',
                'status' => '1',
                'added_from' => '',
                'username' => '',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email_verified_at' =>  date("Y-m-d H:i:s"),
                'remember_token' => null,
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),

        );
        DB::table('users')->insert($userData);
    }
}
