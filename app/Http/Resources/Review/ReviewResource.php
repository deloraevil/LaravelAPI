<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'reviewable_type'=>class_basename($this->reviewable_type),
            'reviewable_id'=>$this->reviewable_id,
            'content'=>$this->content,
            'rating'=>$this->rating,
        ];
    }
}
