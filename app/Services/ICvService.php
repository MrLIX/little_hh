<?php

namespace App\Services;

use App\Models\ApplicantCv;

interface ICvService
{

    /**
     * @return ApplicantCv|false
     */
    public function createCV();

    /**
     * @param ApplicantCv $cv
     * @return ApplicantCv|false
     */
    public function update(ApplicantCv $cv);

}
