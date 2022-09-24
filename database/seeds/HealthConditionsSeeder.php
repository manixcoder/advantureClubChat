<?php

use Illuminate\Database\Seeder;

class HealthConditionsSeeder extends Seeder
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
                'name' => 'Oman debit card',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'name' => 'Oman debit card',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'name' => 'Oman debit card',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'name' => 'Oman debit card',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),


        );
        DB::table('health_conditions')->insert($userData);
    }
}
