<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'locality' => 'required|string',
            'postal_code' => 'required|string|size:5',
            'province' => 'required|string',
            'number' => 'required|string',
            'street' => 'required|string',
            'addressable_type' => 'required|string|in:App\\Models\\Beneficiary,App\\Models\\Contact',
            'addressable_id' => 'required|integer|exists:' . $this->addressable_type . ',id',
        ];
    }

    public function messages(): array
    {
        return [
            'locality.required' => 'Es Necesario Especificar una Localidad',
            'postal_code.required' => 'Es Necesario Indicar un Código Postal',
            'province.required' => 'Es Necesario Especificar una Provincia',
            'number.required' => 'Es Necesario Indicar un Número',
            'street.required' => 'Es Necesario Especificar una Calle',
            'addressable_type.required' => 'Es Necesario Un Tipo de Dirección',
            'addressable_id.required' => 'Es Necesario el ID del Direccionado',
        ];
    }
}
