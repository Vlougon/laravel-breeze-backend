<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiaryRequest extends FormRequest
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
            'name' => 'required|string|max:35',
            'first_surname' => 'required|string|max:35',
            'second_surname' => 'string|max:35',
            'birth_date' => 'required|date',
            'dni' => 'required|string|size:9',
            'social_security_number' => 'required|string|size:12',
            'rutine' => 'string',
            'gender' => 'required|in:Male,Female,Other',
            'marital_status' => 'required|in:Single,Engaged,Married,Divorced,Uncoupled,Widower',
            'beneficiary_type' => 'required|in:Above65,65-45,44-30,29-19,18-12,Below12',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Es Necesario un Nombre (Máx. 35 Letras)',
            'first_surname.required' => 'Es Necesario un Primer Apellido (Máx. 35 Letras)',
            'birth_date.required' => 'Es Necesaria una Fecha de Nacimiento',
            'second_surname.string' => 'El Segundo Apellido no puede exceder 35 letras',
            'dni.required' => 'Es Necesario Especificar un DNI (9 Dígitos)',
            'social_security_number.required' => 'Es Necesario Especificar un Número de la Seguridad Social (12 Dígitos)',
            'rutine' => 'La Rutina del Beneficiario debe ser un Texto',
            'gender.required' => 'Es Necesario Indicar un Género',
            'marital_status.required' => 'Es Necesario Indicar un Estado Social',
            'beneficiary_type.required' => 'Es Necesario Especificar el Tipo de Beneficiario',
        ];
    }
}
