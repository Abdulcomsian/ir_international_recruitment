<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'total_legal_aids' => $this->when(isset($this->legal_aid_count), function () {
                return $this->legal_aid_count;
            }),
            'total_transportations' => $this->when(isset($this->transportation_count), function () {
                return $this->transportation_count;
            }),
            'total_social_service_legal_aids' => $this->when(isset($this->social_service_legal_aid_count), function () {
                return $this->social_service_legal_aid_count;
            }),
        ];
    }
}
