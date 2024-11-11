<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportationResource extends JsonResource
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
            'type' => $this->type,
            'contact_no' => $this->contact_no,
            'image_path' => $this->image_path,
            'from_price' => $this->from_price,
            'to_price' => $this->to_price,
            'price' => $this->from_price !== null && $this->to_price !== null ? null : 'Variable Cost',
            'website_url' => $this->website_url,
            'location' => $this->location,
            'description' => $this->description,
            'city' => new CityResource($this->whenLoaded('city')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
