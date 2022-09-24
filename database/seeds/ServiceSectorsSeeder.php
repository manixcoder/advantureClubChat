<?php

use Illuminate\Database\Seeder;

class ServiceSectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_sectors')->delete();
        $userData = array(
            array(
                'id' => 1,
                'sector' => 'Training',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'sector' => 'Learning',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'sector' => 'Tutor',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),


        );
        DB::table('service_sectors')->insert($userData);
    }
}
