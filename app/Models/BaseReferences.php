<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseReferences extends Model
{
    const TYPE_SKILLS = 'skills';
    const TYPE_POSITIONS = 'positions';
    const TYPE_LANGUAGE = 'language';
    const TYPE_SOCIALS = 'socials';

    /**
     * @return string[]
     */
    public function types(): array
    {
        return [
            self::TYPE_SKILLS => 'Навыки',
            self::TYPE_POSITIONS => 'Позиции',
            self::TYPE_LANGUAGE => 'Язык',
            self::TYPE_SOCIALS => 'Социальные сети',
        ];
    }

    /**
     * @param $type
     * @return string
     */
    public function getTypeText($type): string
    {
        $types = $this->types();
        return $types[$type] ?? $type;
    }
}
