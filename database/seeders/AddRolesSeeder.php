<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AddRolesSeeder extends Seeder
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
                'name' => 'superAdmin',
                'guard_name' => 'api'
            ],
            [
                'name' => 'employer',
                'guard_name' => 'api'
            ],
            [
                'name' => 'applicant',
                'guard_name' => 'api'
            ],
        ];
        DB::table('roles')->insert($data);
    }
}
