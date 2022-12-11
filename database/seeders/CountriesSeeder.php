<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Узбекистан',
                'code' => 'UZ'
            ],
            [
                'id' => 2,
                'name' => 'Россия',
                'code' => 'RU'
            ]
        ];
        DB::table('countries')->insert($data);
    }
}
