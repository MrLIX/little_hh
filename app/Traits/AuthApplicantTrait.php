<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait AuthApplicantTrait
{
    /**
     * @param Builder $query
     * @return Builder|void
     */
    public function scopeAuthApplicant(Builder $query)
    {
        $applicant = User::getAuthUserModelId(User::TYPE_APPLICANT);
        if ($applicant)
            return $query->where('applicant_id', $applicant);
    }
}
