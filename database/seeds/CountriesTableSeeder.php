<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $userData = array(
            array(
                'id' => 1,
                'country' => 'India',
                'short_name'=>'IND',
                'code'=>'+91',
                'currency'=>'₹',
                'description'=>'INDIA',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
                
            ),
            array(
                'id' => 2,
                'country' => 'United State Of America',
                'short_name'=>'USA',
                'code'=>'+1',
                'currency'=>'$',
                'description'=>'United State Of America',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'country' => 'United Arab Emirates',
                'short_name'=>'UAE',
                'code'=>'+971',
                'currency'=>'',
                'description'=>'United Arab Emirates',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'country' => 'Australia',
                'short_name'=>'AUS',
                'code'=>'+61',
                'currency'=>'',
                'description'=>'Australia',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 5,
                'country' => 'Pakistan',
                'short_name'=>'PAK',
                'code'=>'+92',
                'currency'=>'',
                'description'=>'Pakistan',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 6,
                'country' => 'Oman',
                'short_name'=>'OMN',
                'code'=>'+968',
                'currency'=>'',
                'description'=>'Oman',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),

            array(
                'id' => 7,
                'country' => 'INDONESEA',
                'short_name'=>'INDO',
                'code'=>'+62',
                'currency'=>'',
                'description'=>'',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 8,
                'country' => 'JAPAN',
                'short_name'=>'JAN',
                'code'=>'+7',
                'currency'=>'',
                'description'=>'JAN',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 9,
                'country' => 'RUSSIA',
                'short_name'=>'RUS',
                'code'=>'+965',
                'currency'=>'',
                'description'=>'RUS',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 10,
                'country' => 'GERMANY',
                'short_name'=>'GRY',
                'code'=>'+43',
                'currency'=>'',
                'description'=>'GRY',
                'status'=>'1',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            

        );
        DB::table('countries')->insert($userData);
    }
}
