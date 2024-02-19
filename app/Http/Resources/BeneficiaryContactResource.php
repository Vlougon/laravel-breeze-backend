<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'beneficiary_id' => new BeneficiaryResource($this->beneficiaries),
            'contact_id' => new ContactResource($this->contacts),
        ];
    }
}
