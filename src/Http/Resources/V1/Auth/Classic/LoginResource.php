<?php

namespace Bulutly\Laravel\Http\Resources\V1\Buluts;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{

    public function toArray($request){
        return [
            'uuid' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'ip' => $this->ip,
            'project_id' => $this->project_id,
            'image_id' => $this->image_id,
            'image_type' => $this->image_type,
            'cpu' => $this->cpu,
            'memory' => $this->memory,
            'storage' => $this->storage,
            'has_static_ip' => $this->has_static_ip,
            'weekend_shutdown' => $this->weekend_shutdown,
            'auto_scale_cpu' => $this->auto_scale_cpu,
            'auto_scale_memory' => $this->auto_scale_memory,
            'region' => $this->region,
            'last_seen' => $this->last_seen,
            'charge' => $this->charge,
            'startup_script' => $this->startup_script,
            'status' => $this->status,
            'tags' => !empty($this->tags) ? $this->tags->pluck('title') : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
