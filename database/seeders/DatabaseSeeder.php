<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PaymentBrandsTableSeeder::class);
        $this->call(GeneralTextTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(CargoTypeTableSeederSeeder::class);
    }
}
