<?php

use Illuminate\Database\Seeder;

class HealthConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('health_conditions')->delete();
        $userData = array(
            array(
                'id' => 1,
                'name' => 'Good condition',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'name' => 'Bone weakness',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'name' => 'Breath weakness',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'name' => 'Muscles issues',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 5,
                'name' => 'Backbone issues',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 6,
                'name' => 'Joints issues',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 7,
                'name' => 'Ligament issues',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 8,
                'name' => 'Not good conditions',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 9,
                'name' => 'High blood pressure',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 10,
                'name' => 'Low blood pressure',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 11,
                'name' => 'High diabetes',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
           


        );
        DB::table('health_conditions')->insert($userData);
    }
}
