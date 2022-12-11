<?php

namespace App\Http\Resources;

use App\Models\BaseReferences;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferencesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $res = [
            'name' => $this->reference->name,
            'type' => $this->reference_type,
        ];
        if ($this->reference_type == BaseReferences::TYPE_SOCIALS)
            $res['url'] = $this->value;
        if ($this->reference_type == BaseReferences::TYPE_LANGUAGE)
            $res['level'] = $this->value;
        return $res;
    }
}
