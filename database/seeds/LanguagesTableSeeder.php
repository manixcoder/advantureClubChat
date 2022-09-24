<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();
        $userData = array(
            array(
                'id' => 1,
                'code' => 'hn',
                'name'=>'Hindi',
                'description'=>'Hindi',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'code' => 'en',
                'name'=>'English',
                'description'=>'English',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'code' => 'fr',
                'name'=>'French',
                'description'=>'French',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'code' => 'zh-hans',
                'name'=>'Chinese',
                'description'=>'Chinese',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 5,
                'code' => 'ar',
                'name'=>'Arabic',
                'description'=>'Arabic',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            
           


        );
        DB::table('languages')->insert($userData);
    }
}
