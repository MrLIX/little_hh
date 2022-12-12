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

        // Attach Admin
        $user = User::firstWhere('email', 'admin@gmail.com');
        $role = \Spatie\Permission\Models\Role::findByName('superAdmin', 'api');
        $role->users()->attach($user);

        // Attach Employer and add employer info
        $user = User::firstWhere('email', 'employer1@gmail.com');
        $role = \Spatie\Permission\Models\Role::findByName('employer', 'api');
        $role->users()->attach($user);
        $employer = [
            [
                'user_id' => $user->id,
                'location_id' => 1,
                'brand_name' => 'Test Brand',
                'company_name' => 'OOO "Test Company"',
                'logo' => '/logo/employer.png',
                'address' => 'Test address',
                'phone' => '+998 97 999-99-99',
                'email' => 'test@brand.uz',
                'site' => 'test-brand.uz'
            ]
        ];
        DB::table('employers')->insert($employer);

        // Attach applicant and add applicant info
        $user = User::firstWhere('email', 'applicant1@gmail.com');
        $role = \Spatie\Permission\Models\Role::findByName('applicant', 'api');
        $role->users()->attach($user);
        $applicant = [
            [
                'user_id' => $user->id,
                'first_name' => 'Eshmat',
                'last_name' => 'Toshmatov',
                'middle_name' => 'Toshmatovich',
                'phone' => '+998 97 999-99-99',
                'email' => 'test@brand.uz'
            ]
        ];
        DB::table('applicants')->insert($applicant);

    }
}
