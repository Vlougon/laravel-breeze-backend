<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BeneficiaryContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'contact_id' => 'required|exists:contact,id',
        ];
    }

    public function messages(): array
    {
        return [
            'beneficiary_id.required' => 'Es Necesario un Beneficiario',
            'contact_id.required' => 'Es Necesario un Contacto',
        ];
    }
}
