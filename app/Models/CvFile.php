<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $cv_id
 * @property string $name
 * @property string $url
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property ApplicantCv $applicantCv
 */
class CvFile extends Model
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
    protected $fillable = ['cv_id', 'name', 'url', 'type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applicantCv()
    {
        return $this->belongsTo('App\Models\ApplicantCv', 'cv_id');
    }
}
