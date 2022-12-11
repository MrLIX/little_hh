<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyRespondsResource extends JsonResource
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
            'vacancy' => $this->vacancy->name,
            'first_name' => optional($this->application)->first_name,
            'last_name' => optional($this->application)->last_name,
            'middle_name' => optional($this->application)->middle_name,
            'phone' => optional($this->application)->phone,
            'email' => optional($this->application)->email,
            'status' => $this->status,
            'status_text' => $this->statusText(),
            'created_at' => $this->created_at
        ];
    }
}
