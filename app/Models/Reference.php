<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Reference extends BaseReferences
{

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var string
     */
    protected $table = 'references';

    /**
     * @var array
     */
    protected $fillable = ['type', 'name', 'created_at', 'updated_at', 'deleted_at'];

}
