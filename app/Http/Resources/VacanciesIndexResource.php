<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacanciesIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'employer_name' => $this->employer->brand_name,
            'employer_company_name' => $this->employer->company_name,
            'salary' => $this->salary,
            'position' => optional($this->position)->name,
            'work_experience' => $this->work_experience,
            'description' => $this->description,
            'is_online' => $this->is_online,
            'working_hours' => $this->working_hours,
            'status' => $this->status,
            'location' => $this->location->name,
            'skills' => VacancySkillsResource::collection($this->skills),
            'views_count' => $this->views_count,
            'responds_count' => $this->responds_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
