<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:70',
            'password' => 'required|min:10',
            'role' => 'required|in:supervisor,assistant',
            'email' => 'required|email|unique:users',
        ];

        if (in_array($this->getMethod(), ['PUT', 'PATCH'])) {
            $user = $this->route()->parameter('user');
            $rules['email'] .= ',email,' . $user->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Es Necesario un Nombre Completo (Máx. 70 Letras)',
            'password.required' => 'Es Necesaria una Contraseña de Mínimo 10 Dígitos',
            'role.required' => 'Es Necesario Especificar el Rol del Usuario',
            'email.required' => 'Es Necesario Indicar un Email Único para el Usuario',
        ];
    }
}
