<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'contact_type' => 'required|in:Familiar,Friend,Partner,Other',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Es Necesario un Nombre (Máx. 35 Letras)',
            'first_surname.required' => 'Es Necesario un Primer Apellido (Máx. 35 Letras)',
            'second_surname.string' => 'El Segundo Apellido no puede exceder 35 letras',
            'contact_type.required' => 'Es Necesario Indicar el Tipo de Contacto',
        ];
    }
}
