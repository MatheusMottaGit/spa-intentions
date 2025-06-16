<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntentionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'mass_date' => $this->mass_date,
            'contents' => $this->contents,
            'church' => new ChurchResource($this->church),
            'user' => new UserResource($this->user),
        ];
    }
} 