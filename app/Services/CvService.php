<?php

namespace App\Services;

use App\Models\ApplicantCv;
use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CvService implements ICvService
{
    public array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return ApplicantCv|false
     */
    public function createCV()
    {
        DB::beginTransaction();
        try {
            $cv = $this->saveCV();
            $cv->skills()->createMany($this->data['skills']);
            $cv->positions()->createMany($this->data['positions']);
            $cv->languages()->createMany($this->changeValues($this->data['languages'] ?? [], 'level'));
            $cv->socials()->createMany($this->changeValues($this->data['socials'] ?? [], 'url'));
            DB::commit();
            return $cv;
        } catch (\Exception $e) {
            Log::error('ErrorSavingCV#error: ' . $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param ApplicantCv $cv
     * @return ApplicantCv|false
     */
    public function update(ApplicantCv $cv)
    {
        DB::beginTransaction();
        try {
            $cv->fill($this->data);
            $cv->avatar = $this->saveFile('avatar');
            $cv->save();
            $cv->skills()->delete();
            $cv->skills()->createMany($this->data['skills']);
            $cv->positions()->delete();
            $cv->positions()->createMany($this->data['skills']);
            $cv->languages()->delete();
            $cv->languages()->createMany($this->changeValues($this->data['languages'] ?? [], 'level'));
            $cv->socials()->delete();
            $cv->socials()->createMany($this->changeValues($this->data['socials'] ?? [], 'url'));
            DB::commit();
            return $cv;
        } catch (\Exception $e) {
            Log::error('ErrorSavingCV#error: ' . $e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    /**
     * @return ApplicantCv
     */
    protected function saveCV()
    {
        $applicant_id = User::getAuthUserModelId(User::TYPE_APPLICANT);
        $cv = new ApplicantCv();
        $cv->fill($this->data);
        $cv->application_id = $applicant_id;
        $cv->avatar = $this->saveFile('avatar');
        $cv->save();
        return $cv;
    }

    /**
     * @param array $array
     * @param $value
     * @return \Illuminate\Support\Collection
     */
    protected function changeValues(array $array, $value = 'value')
    {
        return collect($array)->map(function ($item) use ($value) {
            return [
                'reference_id' => $item->reference_id,
                'value' => $item->{$value}
            ];
        });
    }

    /**
     * @param $key
     * @return mixed|null
     */
    protected function saveFile($key)
    {
        if (request()->hasFile($key))
            return (new BaseModel())->uploadFile(request(), $key);
        return null;
    }


}
