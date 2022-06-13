<?php

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'names' => [
                'required', 'string'
            ],
            'lastnames' => [
                'required', 'string'
            ],
            'username' => [
                'required', 'string', 'unique:users'
            ],
            'email' => [
                'required', 'email', 'unique:users'
            ],
            'password' => [
                'required', 'string', 'confirmed'
            ]
        ];
    }

    /**
     * Return messages to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'names.required' => 'Los nombres son requeridos',
            'lastnames.required' => 'Los apellidos son requeridos',
            'username.required' => 'El nombre de usuario es requerido',
            'username.unique' => 'El nombre de usuario ya se encuentra en uso',
            'email.required' => 'El correo electrónico es requerido',
            'email.unique' => 'El correo electrónico ya se encuentra registrado',
            'password.required' => 'Ingrese la contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ];
    }
}
