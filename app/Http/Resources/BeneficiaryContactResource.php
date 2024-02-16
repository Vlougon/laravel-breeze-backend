<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'beneficiary_id' => new BeneficiaryResource($this->beneficiary),
            'contact_id' => new ContactResource($this->contact),
        ];
    }
}
