<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'culture_quiz_id' => $this->culture_quiz_id,
            'question_text' => $this->question_text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'options' => OptionResource::collection($this->whenLoaded('answers')), // 'answers' relationship for options
        ];
    }
}
