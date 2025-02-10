<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityVideoResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'video_url' => $this->video_url,
            'is_active'=> $this->is_active,
            'featured_image' => $this->featured_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function with($request)
    {
        return [
            'status' => true,
            'msg' => 'Data Retrived Successfully'
        ];
    }
}
