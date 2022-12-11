<?php

namespace App\Models;


/**
 * @property integer $id
 * @property int $cv_id
 * @property int $reference_id
 * @property string $reference_type
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property ApplicantCv $applicantCv
 * @property Reference $reference
 */
class CvReference extends BaseReferences
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
    protected $fillable = ['cv_id', 'reference_id', 'reference_type', 'value', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applicantCv()
    {
        return $this->belongsTo('App\Models\ApplicantCv', 'cv_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }
}
