<?php

namespace App\Services;

use App\Models\ApplicantCv;
use App\Models\BaseModel;
use App\Models\BaseReferences;
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
            $this->createReferences($cv);
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
            $this->deleteReferences($cv);
            $this->createReferences($cv);
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
        $cv->applicant_id = $applicant_id;
        $cv->avatar = $this->saveFile('avatar');
        $cv->save();
        return $cv;
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

    /**
     * @param ApplicantCv $cv
     * @return void
     */
    protected function createReferences(ApplicantCV $cv): void
    {
        $cv->skills()->createMany(($this->changeValues($this->data['skills'] ?? [], BaseReferences::TYPE_SKILLS)));
        $cv->positions()->createMany($this->changeValues($this->data['positions'] ?? [], BaseReferences::TYPE_POSITIONS));
        $cv->languages()->createMany($this->changeValues($this->data['languages'] ?? [], BaseReferences::TYPE_LANGUAGE, 'level'));
        $cv->socials()->createMany($this->changeValues($this->data['socials'] ?? [], BaseReferences::TYPE_SOCIALS, 'url'));
    }

    /**
     * @param ApplicantCv $cv
     * @return void
     */
    protected function deleteReferences(ApplicantCv $cv): void
    {
        $cv->skills()->delete();
        $cv->positions()->delete();
        $cv->languages()->delete();
        $cv->socials()->delete();
    }

    /**
     * @param array $array
     * @param string $type
     * @param string $value
     * @return array
     */
    protected function changeValues(array $array, string $type, string $value = 'value'): array
    {
        return collect($array)->map(function ($item) use ($value, $type) {
            return [
                'reference_id' => $item['reference_id'],
                'reference_type' => $type,
                'value' => $item[$value] ?? null
            ];
        })->toArray();
    }

}
