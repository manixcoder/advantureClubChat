<?php

use Illuminate\Database\Seeder;

class DependencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dependency')->delete();
        $userData = array(
            array(
                'id' => 1,
                'dependency_name' => 'Wather',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'dependency_name' => 'Health Condition',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'dependency_name' => 'Licence',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),

        );
        DB::table('dependency')->insert($userData);
    }
}
