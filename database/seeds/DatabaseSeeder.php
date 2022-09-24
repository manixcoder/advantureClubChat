<?php

use Illuminate\Database\Seeder;
use Prophecy\Call\Call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(AimedSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(DependencySeeder::class);
        $this->call(DurationsSeeder::class);
        $this->call(GetAllPaymentmodeSeeder::class);
        $this->call(HealthConditionsSeeder::class);
        $this->call(HeightsSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(PackagesSeeder::class);
        $this->call(ServicelevelSeeder::class);
        $this->call(ServiceSectorsSeeder::class);
        $this->call(ServiceCategoriesSeeder::class);
        $this->call(ServiceTypesSeeder::class);
        $this->call(ServicesForSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(ServicePlanSeeder::class);
        $this->call(WeekdaysSeeder::class);
    }
}
