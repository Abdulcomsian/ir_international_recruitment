<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForeignDiplomaResource extends JsonResource
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
            'id' =>$this->id,
            'title' => $this->title,
            'media_path' => $this->media_path,
            'validation_guide' => $this->ValidationGuide->map(function($validation){
                return [
                    'id' =>$validation->id,
                    'diploma_id' => $validation->diploma_id,
                    'validation_organization' =>$validation->validation_organization,
                    'visit_website' => $validation->visit_website,
                    'validation_guides' => $validation->validation_guides,
                    'diploma' => [
                        'title' => $validation->diploma->title,
                        'media_path' => $validation->diploma->media_path
                    ]
                ];
            }),
            'resources' => $this->resources->map(function($resource){
                return [
                    'id' => $resource->id,
                    'diploma_id ' => $resource ->diploma_id,
                    'title' => $resource->title,
                    'visit_website' => $resource->visit_website,
                    'diploma' => [
                        'title' => $resource->diploma->title,
                        'media_path' => $resource->diploma->media_path
                    ]
                ];
            }),
        ];
    }

    //if we have hasOne relation so we will not use map and insted of map return in this way
        //     'validation_guide' => $this->validationGuide ? [
        //     'id' => $this->validationGuide->id,
        //     'diploma_id' => $this->validationGuide->diploma_id,
        //     'validation_organization' => $this->validationGuide->validation_organization,
        //     'visit_website' => $this->validationGuide->visit_website,
        //     'validation_guides' => $this->validationGuide->validation_guides,
        // ] : null,

}
