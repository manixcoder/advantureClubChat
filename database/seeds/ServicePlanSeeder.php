<?php

use Illuminate\Database\Seeder;

class ServicePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_plan')->delete();
        $userData = array(
            array(
                'id' => 1,
                'plan' => 'Month',
                'title'=>'Every particular weekdays',
            ),
            array(
                'id' => 2,
                'plan' => 'Calender',
                'title'=>'Every particular calender date',
            ),

        );
        DB::table('service_plan')->insert($userData);
    }
}
