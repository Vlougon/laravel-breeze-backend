<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
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
            'name' => $this->name,
            'first_surname' => $this->first_surname,
            'second_surname' => $this->second_surname,
            'birth_date' => $this->birth_date,
            'dni' => $this->dni,
            'social_security_number' => $this->social_security_number,
            'rutine' => $this->rutine,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'beneficiary_type' => $this->beneficiary_type,
        ];
    }
}
