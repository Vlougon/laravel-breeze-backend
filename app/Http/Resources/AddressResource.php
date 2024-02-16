<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'locality' => $this->locality,
            'postal_code' => $this->postal_code,
            'province' => $this->province,
            'number' => $this->number,
            'street' => $this->street,
        ];
    }
}
