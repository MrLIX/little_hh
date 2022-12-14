<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddRolesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(ReferencesSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
