<?php

namespace Database\Seeders;

use App\Models\BaseReferences;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferencesSeeder extends Seeder
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
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Программист, разработчик',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Военнослужащий',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Администратор',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Офис-менеджер',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Аналитик',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Дизайнер, художник',
            ],
            [
                'type' => BaseReferences::TYPE_POSITIONS,
                'name' => 'Дизайнер, художник',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'Управление проектами',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'Git',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'HTML',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'CSS',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'JavaScript',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'Java',
            ],
            [
                'type' => BaseReferences::TYPE_SKILLS,
                'name' => 'PHP',
            ],
            [
                'type' => BaseReferences::TYPE_LANGUAGE,
                'name' => 'Узбек',
            ],
            [
                'type' => BaseReferences::TYPE_LANGUAGE,
                'name' => 'Русский',
            ],
            [
                'type' => BaseReferences::TYPE_LANGUAGE,
                'name' => 'Английский',
            ],
            [
                'type' => BaseReferences::TYPE_SOCIALS,
                'name' => 'LinkedIn',
            ],
            [
                'type' => BaseReferences::TYPE_SOCIALS,
                'name' => 'Facebook',
            ],
            [
                'type' => BaseReferences::TYPE_SOCIALS,
                'name' => 'Twitter',
            ],
            [
                'type' => BaseReferences::TYPE_SOCIALS,
                'name' => 'Telegram',
            ],
        ];
        DB::table('references')->insert($data);
    }
}
