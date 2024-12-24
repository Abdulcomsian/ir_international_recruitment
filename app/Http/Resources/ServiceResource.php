<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    // public static $wrap = 'data';

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
            'name' => $this->title,
            'imagePath' => $this->image_path
        ];
    }

    public function with($request)
    {
        return ['status' => 'success','status_code'=>200, 'message'=>'Services Found Successfully'];
    }
}
