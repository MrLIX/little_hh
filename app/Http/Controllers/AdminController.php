<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function vacancies()
    {
        $vacancies = DB::select("select v.*,
                           count(vv.id) as view_count,
                           count(vr.id) as respond_count
                    from vacancies v
                             left join vacancy_views vv on v.id = vv.vacancy_id
                             left join vacancy_responds vr on v.id = vr.vacancy_id
                    where v.deleted_at is null
                    group by v.id");
        return success_out($vacancies);
    }

    public function cvs()
    {
        $cvs = DB::select("select cv.*,
                               count(vr.id) as responds_count
                        from applicant_cvs cv
                                 left join vacancy_responds vr on cv.id = vr.cv_id
                        where cv.created_at >= NOW()::DATE - EXTRACT(DOW FROM NOW())::INTEGER - 7  and cv.deleted_at is null
                        group by cv.id");
        return success_out($cvs);
    }


}
