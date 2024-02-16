<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'repeat' => 'string|nullable',
            'background_color' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Es Necesario un Asistente',
            'beneficiary_id.required' => 'Es Necesario un Beneficiario',
            'title.required' => 'Es Necesario un Título Único para el Recordatorio',
            'start_date.required' => 'Es Necesaria la Fecha de Inicio',
            'end_date.required' => 'Es Necesaria la Fecha de Finalización',
            'start_time.required' => 'Es Necesaria la Hora de Inicio',
            'end_time.required' => 'Es Necesaria la Hora de Finalización',
            'repeat.string' => 'Los Días para Repetir deben ser Texto',
            'background_color.required' => 'Es Necesario Indicar un Color para el Recordatorio',
        ];
    }
}
