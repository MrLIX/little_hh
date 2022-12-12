<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCVRequest;
use App\Http\Resources\ApplicantCVResource;
use App\Http\Resources\VacanciesIndexResource;
use App\Models\ApplicantCv;
use App\Models\Vacancy;
use App\Models\VacancyRespond;
use App\Services\CvService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $cvs = ApplicantCv::query()
            ->with(['applicant', 'files', 'skills', 'positions', 'languages', 'socials'])
            ->authApplicant()
            ->orderBy('id')
            ->get();
        return success_out(ApplicantCVResource::collection($cvs));
    }

    /**
     * @param CreateCVRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(CreateCVRequest $request)
    {
        $data = $request->validated();
        $cv = (new CvService($data))->createCV();
        if ($cv)
            return success_out(ApplicantCVResource::make($cv));
        return error_out([], 422, 'Ошибка при создании!');
    }

    /**
     * @param ApplicantCv $cv
     * @param CreateCVRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ApplicantCv $cv, CreateCVRequest $request)
    {
        $data = $request->validated();
        $cv = (new CvService($data))->update($cv);
        if ($cv)
            return success_out(ApplicantCVResource::make($cv));
        return error_out([], 422, 'Ошибка при обновлении!');
    }

    /**
     * @param ApplicantCv $cv
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function view(ApplicantCv $cv)
    {
        return success_out(ApplicantCVResource::make($cv));
    }

    /**
     * @param ApplicantCv $cv
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(ApplicantCv $cv)
    {
        try {
            $cv->delete();
            return success_out(true);
        } catch (\Exception $e) {
            return error_out(['message' => $e->getMessage()], 422, 'Ошибка при удалении');
        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function vacancies(ApplicantCv $cv)
    {
        $vacancies = Vacancy::query()
            ->select('vacancies.*')
            ->with(['location', 'employer', 'skills'])
            ->withCount(['views', 'responds'])
            ->positionFilter($cv->positions->map(fn($p) => $p->reference_id)->toArray())
            ->paginate();
        return success_out(VacanciesIndexResource::collection($vacancies), true);
    }

    public function vacancyView(Vacancy $vacancy)
    {
        $vacancy->addView();
        $vacancy->with(['location', 'employer', 'skills'])
            ->withCount('views');
        return success_out(VacanciesIndexResource::make($vacancy));
    }

    public function respondVacancy(Vacancy $vacancy, Request $request)
    {
        $data = $request->validate([
            'cv_id' => 'required|integer|exists:applicant_cvs,id'
        ]);
        $respond = VacancyRespond::query()
            ->where('vacancy_id', $vacancy->id)
            ->where('cv_id', $vacancy->id)
            ->where('user_id', Auth::id())
            ->first();
        if ($respond)
            return error_out([], 422, 'Вы уже откликнули на эту вакансию');

        $vacancy->respond($data['cv_id']);
        $vacancy->with(['location', 'employer', 'skills'])
            ->withCount('views');
        return success_out(VacanciesIndexResource::make($vacancy));
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function respondVacancies(Vacancy $vacancy, Request $request)
    {
        $data = $request->validate([
            'cv_id' => 'required|integer|exists:applicant_cvs,id'
        ]);
        $vacancies = Vacancy::query()
            ->select('vacancies.*')
            ->with(['location', 'employer', 'skills'])
            ->withCount(['views', 'responds'])
            ->leftJoin('vacancy_responds', 'vacancy_responds.vacancy_id', 'vacancies.id')
            ->where('vacancy_responds.user_id', Auth::id())
            ->where('vacancy_responds.vacancy_id', $vacancy->id)
            ->where('vacancy_responds.cv_id', $data['cv_id'])
            ->paginate();
        return success_out(VacanciesIndexResource::collection($vacancies), true);
    }


}
