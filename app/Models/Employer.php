<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $user_id
 * @property int $location_id
 * @property string $brand_name
 * @property string $company_name
 * @property string $logo
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Location $location
 * @property User $user
 * @property Vacancy[] $vacancies
 */
class Employer extends Model
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
    protected $fillable = ['user_id', 'location_id', 'brand_name', 'company_name', 'logo', 'address', 'phone', 'email', 'site', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacancies()
    {
        return $this->hasMany('App\Models\Vacancy');
    }
}
