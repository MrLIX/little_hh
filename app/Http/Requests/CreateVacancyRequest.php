<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVacancyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'location_id' => 'required|integer|exists:locations,id',
            'position_id' => 'required|integer|exists:references,id',
            'name' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'work_experience' => 'nullable|integer',
            'description' => 'required|string|max:1024',
            'is_online' => 'required|boolean',
            'working_hours' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*.reference_id' => 'required|integer|exists:references,id'
        ];
    }
}
