<?php

use Illuminate\Database\Seeder;

class GetAllPaymentmodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('get_all_paymentmode')->delete();
        $userData = array(
            array(
                'id' => 1,
                'payment_name' => 'Oman debit card',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'payment_name' => 'International visa card',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'payment_name' => 'pay on arrival',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'payment_name' => 'PayPal',
                'payment_image' => 'oman_debitCards.png',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),


        );
        DB::table('get_all_paymentmode')->insert($userData);
    }
}
