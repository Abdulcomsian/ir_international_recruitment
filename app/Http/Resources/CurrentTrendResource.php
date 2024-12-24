<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentTrendResource extends JsonResource
{
    // public static $wrap= 'data';
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
            'title' => $this->title,
            'category' => $this->category,
            'image_path' => $this->image_path,

        ];

    }

    // public function with($request)
    // {
    //     return [
    //         'status_code' =>200,
    //         'status' => true,
    //         'message' => 'Current Trend Fetched Successfully'
    //     ];
    // }
}
