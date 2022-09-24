<?php

use Illuminate\Database\Seeder;

class ServicesForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_for')->delete();
        $userData = array(
            array(
                'id' => 1,
                'sfor' => 'Kids',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'sfor' => 'Ladies',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'sfor' => 'Families',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            

        );
        DB::table('service_for')->insert($userData);
    }
}
