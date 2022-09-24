<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->delete();
        $userData = array(
            array(
                'id' => 1,
                'title' => '1 Week',
                'symbol' => '$',
                'duration' => '0.00',
                'cost' => '0.00',
                'offer_cost' => '0.00',
                'days' => '7',
                'status' => '1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),

        );
        DB::table('packages')->insert($userData);
    }
}
