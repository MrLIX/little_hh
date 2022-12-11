<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
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
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Город Ташкент'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Андижанская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Бухаринская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Жиззахская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Фарганская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Наманганская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Навоийская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Самаркандская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Сурхондаринская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Тошкентская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Кашкадаринская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Каракалпагистанская республика'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Хорезмская область'
            ],
            [
                'country_id' => 1,
                'parent_id' => null,
                'name' => 'Сирдаринская область'
            ]
        ];
        DB::table('locations')->insert($data);
    }
}
