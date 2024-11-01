<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{
        public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' =>$this->id,
            'title'=> $this->title,
            'description' => $this->description,
            'details' => $this->details,
            'media' => $this->media->map(function($media){
                return [
                    'id' => $media->id,
                    'quebec_history_id' => $media->quebec_history_id,
                    'is_featured' => $media->is_featured,
                    'media_url' => $media->media_url,
                ];
            }),
        ];

    }
}
