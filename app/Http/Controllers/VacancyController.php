<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVacancyRequest;
use App\Http\Resources\VacanciesIndexResource;
use App\Http\Resources\VacancyRespondsResource;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::query()
            ->with(['location', 'employer', 'skills', 'position'])
            ->withCount(['views', 'responds'])
            ->authEmployer()
            ->paginate();
        return success_out(VacanciesIndexResource::collection($vacancies), true);
    }

    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function view(Vacancy $vacancy)
    {
        $vacancy->with(['location', 'employer', 'skills', 'position'])
            ->withCount(['views', 'responds']);
        return success_out(new VacanciesIndexResource($vacancy));
    }

    /**
     * @param CreateVacancyRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(CreateVacancyRequest $request)
    {
        $data = $request->validated();
        $vacancy = (new Vacancy())->createFromData($data);
        if ($vacancy) {
            $vacancy->skills()->createMany($data['skills']);
            return success_out(new VacanciesIndexResource($vacancy));
        }
        return error_out([], 422, 'Ошибка при создании!');
    }

    /**
     * @param Vacancy $vacancy
     * @param CreateVacancyRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Vacancy $vacancy, CreateVacancyRequest $request)
    {
        $data = $request->validated();
        $vacancy->fill($data);
        if ($vacancy->save()) {
            $vacancy->skills()->delete();
            $vacancy->skills()->create($data['skills']);
            return success_out(new VacanciesIndexResource($vacancy));
        }
        return error_out([], 422, 'Ошибка при обнавлении!');
    }

    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Vacancy $vacancy)
    {
        try {
            $vacancy->skills()->delete();
            $vacancy->delete();
            return success_out(true);
        } catch (\Exception $e) {
            return error_out(['message' => $e->getMessage()], 422, 'Ошибка при удалении');
        }
    }

    /**
     * @param Vacancy $vacancy
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function responds(Vacancy $vacancy)
    {
        return success_out(VacancyRespondsResource::collection($vacancy->responds()));
    }

}
