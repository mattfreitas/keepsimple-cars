<?php

namespace App\Http\Resources;

use App\Http\Resources\ModelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MakeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'models' => ModelResource::collection(
                $this->models->when($request->query('vehicle_type_id'), function($query) use($request) {
                    return $query->where('vehicle_type_id', $request->query('vehicle_type_id'));
                })->unique('name')
            ),
        ];
    }
}
