<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCVRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'work_experience' => 'nullable|integer',
            'salary' => 'nullable|numeric',
            'description' => 'required|string|max:2048',
            'about_me' => 'required|string|max:1024',
            'is_online' => 'required|boolean',
            'avatar' => 'nullable|image|max:4096',
            'skills' => 'nullable|array',
            'skills.*.reference_id' => 'required|integer|exists:references,id',
            'positions' => 'nullable|array',
            'positions.*.reference_id' => 'required|integer|exists:references,id',
            'languages' => 'nullable|array',
            'languages.*.reference_id' => 'required|integer|exists:references,id',
            'languages.*.level' => 'required|string|max:255',
            'socials' => 'nullable|array',
            'socials.*.reference_id' => 'required|integer|exists:references,id',
            'socials.*.url' => 'required|string|max:255',
            'portfolio' => 'required|array',
            'portfolio.*.name' => 'required|string|max:200',
            'portfolio.*.file' => 'required|file'
        ];
    }
}
