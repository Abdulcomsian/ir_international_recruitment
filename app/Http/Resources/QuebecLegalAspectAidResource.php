<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuebecLegalAspectAidResource extends JsonResource
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
            'title' => $this->title,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'image_path' => $this->image_path,
            'legal_aspect' => new QuebecLegalAspectResource($this->whenLoaded('quebecLegalAspect')),
            'city' => new CityResource($this->whenLoaded('city')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
