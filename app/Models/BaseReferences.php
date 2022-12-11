<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseReferences extends Model
{
    const TYPE_SKILLS = 'skills';
    const TYPE_POSITIONS = 'positions';
    const TYPE_LANGUAGE = 'language';
    const TYPE_SOCIALS = 'socials';
}
