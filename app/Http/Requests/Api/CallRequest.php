<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CallRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'beneficiary_id' => 'required|integer|exists:beneficiaries,id',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|string',
            'call_type' => 'required|in:rutinary,emergency',
            'call_kind' => 'required|in:incoming,outgoing',
            'turn' => 'required|in:morning,afternoon,night',
            'answered_call' => 'required|boolean',
            'observations' => 'required|string',
            'description' => 'string',
            'contacted_112' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Es Necesario un Asistente',
            'beneficiary_id.required' => 'Es Necesario un Beneficiario',
            'date.required' => 'Es Necesaria una Fecha',
            'time.required' => 'Es Necesaria una Hora',
            'duration.required' => 'Es Necesaria la Duración de la Llamada',
            'call_type.required' => 'Es Necesario Especificar el Tipo de Llamada',
            'call_kind.required' => 'Es Necesario Especificar la Clase de la Llamada',
            'turn.required' => 'Es Necesario Indicar el Turno Horario',
            'answered_call.required' => 'Es Necesario Saber si la Llamada ha sido respondida o no',
            'observations.required' => 'Es Necesario Añadir Observaciones',
            'description.string' => 'La Descripción debe ser Texto',
            'contacted_112.boolean' => 'Saber si se ha contactado con el 112 debe ser verdadero o falso',
        ];
    }
}
