<?php

use Illuminate\Database\Seeder;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_types')->delete();
        $userData = array(
            array(
                'id' => 1,
                'type' => 'Hiking',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'type' => 'Skiing',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'type' => 'Parachuting',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),


        );
        DB::table('service_types')->insert($userData);
    }
}
