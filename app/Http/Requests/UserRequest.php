<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                // 'email',
                // Rule::unique('users', 'email')->ignore($userId)
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'active' => 'sometimes|boolean',
            'rol' => 'required|in:admin,cajero'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',

            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Debe ingresar un correo electrónico válido',

            // 'email.unique' => 'Este correo electrónico ya está registrado',

            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',

            'rol.required' => 'Debe seleccionar un rol',
            'rol.in' => 'Rol seleccionado no válido'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'active' => 'estado activo',
            'rol' => 'rol'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'active' => (bool) $this->active
        ]);

        if ($this->isMethod('put') && empty($this->password)) {
            $this->request->remove('password');
        }
    }
}
