<?php

namespace App\Models;


/**
 * @property integer $id
 * @property int $vacancy_id
 * @property int $reference_id
 * @property string $reference_type
 * @property string $created_at
 * @property string $updated_at
 * @property Reference $reference
 * @property Vacancy $vacancy
 */
class VacancyReference extends BaseReferences
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['vacancy_id', 'reference_id', 'reference_type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy');
    }
}
