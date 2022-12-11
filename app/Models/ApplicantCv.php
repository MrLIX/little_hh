<?php

namespace App\Models;

use App\Traits\AuthApplicantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * @property integer $id
 * @property int $application_id
 * @property string $name
 * @property string $avatar
 * @property int $work_experience
 * @property float $salary
 * @property string $description
 * @property string $about_me
 * @property boolean $is_online
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Applicant $applicant
 * @property CvFile[] $cvFiles
 * @property CvReference[] $cvReferences
 */
class ApplicantCv extends Model
{
    use AuthApplicantTrait;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['application_id', 'name', 'avatar', 'work_experience', 'salary', 'description', 'about_me', 'is_online', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicant', 'application_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\Models\CvFile', 'cv_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references()
    {
        return $this->hasMany('App\Models\CvReference', 'cv_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions()
    {
        return $this->hasMany('App\Models\VacancyReference')->where('type', BaseReferences::TYPE_POSITIONS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->hasMany('App\Models\VacancyReference')->where('type', BaseReferences::TYPE_SKILLS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function languages()
    {
        return $this->hasMany('App\Models\VacancyReference')->where('type', BaseReferences::TYPE_LANGUAGE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials()
    {
        return $this->hasMany('App\Models\VacancyReference')->where('type', BaseReferences::TYPE_SOCIALS);
    }


}
