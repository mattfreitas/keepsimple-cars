<?php

namespace App\Http\Resources;

use App\Http\Resources\VersionResource;
use App\Http\Resources\VehicleTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
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
            'versions' => VersionResource::collection($this->getAvailableVersions()),
            'vehicle_type' => new VehicleTypeResource($this->vehicle_type),
        ];
    }
}
