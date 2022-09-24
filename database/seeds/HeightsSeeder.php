<?php

use Illuminate\Database\Seeder;

class HeightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heights')->delete();
        $userData = array(
            array(
                'id' => 1,
                'heightName' => 'Between 122cm (4ft) and 130cm (4.27ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 2,
                'heightName' => 'Between 130cm (4.27ft) and 140cm (4.59ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 3,
                'heightName' => 'Between 140cm (4.59ft) and 150cm (4.92ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 4,
                'heightName' => 'Between 150cm (4.92ft) and 160cm (5.25ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 5,
                'heightName' => 'Between 160cm (5.25ft) and 170cm (5.58ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 6,
                'heightName' => 'Between 170cm (5.58ft) and 180cm (5.91ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 7,
                'heightName' => 'Between 180cm (5.91ft) and 190cm (6.23ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 8,
                'heightName' => 'Between 190cm (6.23ft) and 200cm (6.56ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
            array(
                'id' => 9,
                'heightName' => 'Between 200cm (6.56ft) and 201cm (6.59ft)',
                'created_at' =>  date("Y-m-d H:i:s"),
                'updated_at' =>  date("Y-m-d H:i:s"),
            ),
           
           


        );
        DB::table('heights')->insert($userData);
    }
}
