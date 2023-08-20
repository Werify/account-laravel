<?php

namespace Werify\Account\Laravel\Http\Resources\V1\Authorize\Classic;

use Illuminate\Http\Resources\Json\JsonResource;

class StartResource extends JsonResource
{

    public function toArray($request){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'token' => $this->token,
            'owner_id' => $this->owner_id,
            'owner_type' => $this->owner_type,
            'restricts' => $this->restricts,
            'scopes' => $this->scopes,
            'url' => $this->url,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
