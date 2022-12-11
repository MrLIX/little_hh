<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12345'),
                'type' => User::TYPE_ADMIN,
                'status' => User::STATUS_ACTIVE
            ],
            [
                'email' => 'employer1@gmail.com',
                'password' => Hash::make('admin12345'),
                'type' => User::TYPE_EMPLOYER,
                'status' => User::STATUS_ACTIVE
            ],
            [
                'email' => 'applicant1@gmail.com',
                'password' => Hash::make('admin12345'),
                'type' => User::TYPE_APPLICANT,
                'status' => User::STATUS_ACTIVE
            ]
        ];
        DB::table('users')->insert($users);
    }
}
