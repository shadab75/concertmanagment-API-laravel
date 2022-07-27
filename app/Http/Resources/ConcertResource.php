<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'title'=>$this->title,
          'description'=>$this->description,
          'start_at'=>$this->start_at,
          'ends_at'=>$this->ends_at,
          'is_publish'=>$this->is_publish,
          'artist'=>new ArtistResource($this->artist)
        ];
    }
}
