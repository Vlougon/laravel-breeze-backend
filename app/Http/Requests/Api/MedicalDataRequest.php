<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MedicalDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'beneficiary_id' => 'required|integer|exists:beneficiaries,id',
            'allergies' => 'string',
            'illnesses' => 'string',
            'morning_medication' => 'string',
            'afternoon_medication' => 'string',
            'night_medication' => 'string',
            'preferent_morning_calls_hour' => 'required',
            'preferent_afternoon_calls_hour' => 'required',
            'preferent_night_calls_hour' => 'required',
            'emergency_room_on_town' => 'required|in:Yes,No',
            'firehouse_on_town' => 'required|in:Yes,No',
            'police_station_on_town' => 'required|in:Yes,No',
            'outpatient_clinic_on_town' => 'required|in:Yes,No',
            'ambulance_on_town' => 'required|in:Yes,No',
        ];
    }

    public function messages(): array
    {
        return [
            'beneficiary_id.required' => 'Es Necesario un Beneficiario',
            'allergies.string' => 'Debe ser Texto',
            'illnesses.string' => 'Debe ser Texto',
            'morning_medication.string' => 'Debe ser Texto',
            'afternoon_medication.string' => 'Debe ser Texto',
            'night_medication.string' => 'Debe ser Texto',
            'preferent_morning_calls_hour.required' => 'Es Necesario Especificar una Hora de Llamada por la Mañana Adecuada',
            'preferent_afternoon_calls_hour.required' => 'Es Necesario Especificar una Hora de Llamada por la Tarde Adecuada',
            'preferent_night_calls_hour.required' => 'Es Necesario Especificar una Hora de Llamada por la Noche Adecuada',
            'emergency_room_on_town.required' => 'Es Necesario Indicar si hay Sala de Urgencias en la Localidad',
            'firehouse_on_town.required' => 'Es Necesario Indicar si hay Bomberos en la Localidad',
            'police_station_on_town.required' => 'Es Necesario Indicar si hay una Estación de Policía en la Localidad',
            'outpatient_clinic_on_town.required' => 'Es Necesario Indicar si hay un Ambulatorio en la Localidad',
            'ambulance_on_town.required' => 'Es Necesario Indicar si hay Ambulancias en la Localidad',
        ];
    }
}
