<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    const TYPE_ADMIN = 'superAdmin';
    const TYPE_EMPLOYER = 'employer';
    const TYPE_APPLICANT = 'applicant';

    const TTL_ORGANISATION_ID = 360000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    public static function typesList(): array
    {
        return [
            self::TYPE_ADMIN,
            self::TYPE_APPLICANT,
            self::TYPE_EMPLOYER
        ];
    }

    /**
     * Will be return employer or applicant ID  from cache;
     * @param $type
     * @param $userId
     * @return mixed|null
     */
    public static function getAuthUserModelId($type = self::TYPE_EMPLOYER, $userId = null)
    {
        if (empty(Auth::id()))
            return null;

        if (!$userId)
            $userId = Auth::id();

        return Cache::remember('user_id_' . $userId, self::TTL_ORGANISATION_ID, function () use ($userId, $type) {
            if ($type == self::TYPE_EMPLOYER)
                $user = Employer::query()->firstWhere('user_id', $userId);
             elseif ($type == self::TYPE_APPLICANT)
                 $user = Applicant::query()->firstWhere('user_id', $userId);
            return !empty($user) ? $user->id : null;
        });
    }
}
