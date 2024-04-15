<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\GenreResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $genres = [];

        foreach ($this->genres as $genre) {
            $genres[] = [
                'genre_id' => $genre->id,
                'name' => $genre->name,
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'genre' => $genres,
            'publisher' => $this->publisher,
            'image_path' => url('/'). '/storage/' .$this->image_path,
            'release_year' => $this->release_year,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'console' => [
                'console_id' => $this->console->id,
                'name' => $this->console->name,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
