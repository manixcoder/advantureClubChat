<?php

use Illuminate\Database\Seeder;

class ServicelevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_levels')->delete();
        $userData = array(
            array(
                'id' => 1,
                'level' => 'Beginner',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'level' => 'Moderate',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'level' => 'Advanced',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            

        );
        DB::table('service_levels')->insert($userData);
    }
}
