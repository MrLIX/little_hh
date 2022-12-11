<?php

namespace App\Models;

use App\Traits\AuthEmployerTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

/**
 * @property integer $id
 * @property int $employer_id
 * @property int $location_id
 * @property int $position_id
 * @property string $name
 * @property float $salary
 * @property int $work_experience
 * @property string $description
 * @property boolean $is_online
 * @property string $working_hours
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Employer $employer
 * @property Location $location
 * @property VacancyView[] $vacancyViews
 * @property VacancyRespond[] $vacancyResponds
 * @property VacancyReference[] $vacancyReferences
 */
class Vacancy extends Model
{

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const STATUS_ARCHIVE = 5;

    use SoftDeletes, AuthEmployerTrait;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['employer_id', 'location_id', 'position_id', 'name', 'salary', 'work_experience', 'description', 'is_online', 'working_hours', 'status', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer()
    {
        return $this->belongsTo('App\Models\Employer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views()
    {
        return $this->hasMany('App\Models\VacancyView');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responds()
    {
        return $this->hasMany('App\Models\VacancyRespond');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function references()
    {
        return $this->hasMany('App\Models\VacancyReference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\VacancyReference', 'position_id');
    }

    public function skills()
    {
        return $this->hasMany('App\Models\VacancyReference')->where('type', BaseReferences::TYPE_SKILLS);
    }

    /**
     * @param array $data
     * @return Vacancy|false
     */
    public function createFromData(array $data)
    {
        try {
            $employer_id = User::getAuthUserModelId();
            $vacancy = new self();
            $vacancy->fill($data);
            $vacancy->employer_id = $employer_id;
            $vacancy->save();
            return $vacancy;
        } catch (\Exception $e) {
            Log::error('ErrorWhenSavingCV#error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @param Builder $q
     * @param $positionsIds
     * @return Builder
     */
    public function scopePositionFilter(Builder $q, $positionsIds)
    {
        return $q->whereIn('positions_id', $positionsIds);
    }


}
