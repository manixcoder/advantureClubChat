<?php

use Illuminate\Database\Seeder;

class ServiceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_categories')->delete();
        $userData = array(
            array(
                'id' => 1,
                'category' => 'Beginner',
                'image'=>'',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'category' => 'Moderate',
                'image'=>'',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'category' => 'Advanced',
                'image'=>'',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            

        );
        DB::table('service_categories')->insert($userData);
    }
}
