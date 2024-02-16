<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'time' => $this->time,
            'duration' => $this->duration,
            'call_type' => $this->call_type,
            'call_kind' => $this->call_kind,
            'turn' => $this->turn,
            'answered_call' => $this->answered_call,
            'observations' => $this->observations,
            'description' => $this->description,
            'contacted_112' => $this->contacted_112,
            'user_id' => new UserResource($this->user),
            'beneficiary_id' => new BeneficiaryResource($this->beneficiary),
        ];
    }
}
