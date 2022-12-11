<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $vacancy_id
 * @property int $user_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Vacancy $vacancy
 */
class VacancyRespond extends Model
{
    const STATUS_NEW = 1;
    const STATUS_INVENT = 10;
    const STATUS_REJECT = 0;
    const STATUS_ARCHIVE = 2;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['vacancy_id', 'user_id', 'status', 'created_at', 'updated_at'];

    public function statuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_ARCHIVE => "Архив",
            self::STATUS_INVENT => "Приглошен",
            self::STATUS_REJECT => "Отказ"
        ];
    }

    public function statusText()
    {
        $statuses = $this->statuses();
        return $statuses[$this->status] ??$this->status;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy');
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'user_id', 'user_id');
    }
}
