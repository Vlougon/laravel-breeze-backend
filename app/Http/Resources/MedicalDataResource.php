<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalDataResource extends JsonResource
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
            'illnesses' => $this->illnesses,
            'allergies' => $this->allergies,
            'morning_medication' => $this->morning_medication,
            'afternoon_medication' => $this->afternoon_medication,
            'night_medication' => $this->night_medication,
            'preferent_morning_calls_hour' => $this->preferent_morning_calls_hour,
            'preferent_afternoon_calls_hour' => $this->preferent_afternoon_calls_hour,
            'preferent_night_calls_hour' => $this->preferent_night_calls_hour,
            'emergency_room_on_town' => $this->emergency_room_on_town,
            'firehouse_on_town' => $this->firehouse_on_town,
            'police_station_on_town' => $this->police_station_on_town,
            'outpatient_clinic_on_town' => $this->outpatient_clinic_on_town,
            'ambulance_on_town' => $this->ambulance_on_town,
            'beneficiary_id' => new BeneficiaryResource($this->beneficiary),
        ];
    }
}
