<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookListDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id,
            'title' => $this->title,
            'penerbit' => $this->penerbit,
            'price' => $this->price,
            'category' => $this->category,
            'author' => $this->author,
            'admin_name' => $this->whenLoaded('admin_name')
        ];
    }
}
