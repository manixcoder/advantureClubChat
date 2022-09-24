<?php

use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();
        $userData = array(
            array(
                'id' => 1,
                'country_id' => '1',
                'region' => 'Delhi',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
        );
        DB::table('regions')->insert($userData);
    }
}
