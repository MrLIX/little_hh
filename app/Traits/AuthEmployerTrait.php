<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait AuthEmployerTrait
{
    /**
     * @param Builder $query
     * @return Builder|void
     */
    public function scopeAuthEmployer(Builder $query)
    {
        $employer_id = User::getAuthUserModelId();
        if ($employer_id)
            return $query->where('employer_id', $employer_id);
    }
}
