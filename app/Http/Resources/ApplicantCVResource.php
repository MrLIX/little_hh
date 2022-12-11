<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantCVResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->applicant->first_name,
            'last_name' => $this->applicant->last_name,
            'middle_name' => $this->applicant->middle_name,
            'phone' => $this->applicant->phone,
            'email' => $this->applicant->email,
            'avatar' => $this->avatar,
            'work_experience' => $this->work_experience,
            'salary' => $this->salary,
            'description' => $this->description,
            'about_me' => $this->about_me,
            'is_online' => $this->is_online,
            'skills' => ReferencesResource::collection($this->skills),
            'positions' => ReferencesResource::collection($this->positions),
            'languages' => ReferencesResource::collection($this->languages),
            'socials' => ReferencesResource::collection($this->socials),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
