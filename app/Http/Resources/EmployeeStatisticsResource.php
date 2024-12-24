<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeStatisticsResource extends JsonResource
{
    // public static $wrap = 'state';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'title' => $this->title,
            'state' => $this->state,
            'label' => $this->label,
            'image_path' => $this->image_path
        ];
    }

    // public function with($request)
    // {
    //     return [
    //         'status_code' =>200,
    //         'status' => true,
    //         'message' => 'Employees Statistics Fetched Successfully'
    //     ];
    // }
}
