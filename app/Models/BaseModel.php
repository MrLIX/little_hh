<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\BaseModel
 *
 * @mixin Builder
 * @method static BaseModel query()
 * @method BaseModel filterWhere(...$condition)
 * @method BaseModel orFilterWhere(...$condition)
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 */
class BaseModel extends Model
{
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    /**
     * @param Builder $query
     * @param mixed ...$args
     * @return Builder
     */
    public function scopeFilterWhere(Builder $query, ...$args)
    {
        if (count($args) === 1) {
            if (is_array($args[0])) {
                $args = $args[0];
            } else return $query;
        }
        if (count($args) === 2) {
            if (!is_null($args[1])) {
                return $query->where(...$args);
            }
        } else if (count($args) === 3) {
            if (!is_null($args[2])) {
                return $query->where(...$args);
            }
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param mixed ...$args
     * @return Builder
     */
    public function scopeOrFilterWhere(Builder $query, ...$args)
    {
        if (count($args) === 1) {
            if (is_array($args[0])) {
                $args = $args[0];
            } else return $query;
        }
        if (count($args) === 2) {
            if (!is_null($args[1])) {
                return $query->orWhere(...$args);
            }
        } else if (count($args) === 3) {
            if (!is_null($args[2])) {
                return $query->orWhere(...$args);
            }
        }
        return $query;
    }

    /**
     * @param Request $request
     * @param $key
     * @return mixed|null
     */
    public function uploadFile(Request $request, $key)
    {
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            return $this->upload($image);
        }

        return null;
    }

    /**
     * @param UploadedFile $image
     * @return mixed
     */
    private function upload(UploadedFile $image)
    {
        $name = rand() . '-' . time() . '-' . clearPhone($image->getClientOriginalName());
        return Storage::disk('public')->putFileAs('files', $image, $name);
    }

}
