<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUserRequest extends FormRequest
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
            'user_id' => 'required',
            'phone_number' => 'required|size:9',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Es Necesario un Asistente',
            'phone_number.required' => 'Es Necesario un Número de Teléfono (9 Dígitos)',
        ];
    }
}
