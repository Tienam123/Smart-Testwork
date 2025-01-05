<?php

namespace App\Http\Resources\Films;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmsResource extends JsonResource
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
            'name' => $this->title,
            'thumbnail' => url('/storage/'.$this->thumbnail),
        ];
    }
}
