<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customer = $this->route('customer');

        return [
            'document' => [
                'required',
                'string',
                'min:13',
                'max:15'
                // Rule::unique('customers')->ignore($customer?->id)
            ],
            'name' => 'required|string|max:150',
            'type' => 'required|string|max:50',
            'city_id' => 'required|exists:cities,id'
        ];
    }

    public function messages(): array
    {
        return [
            'document.required' => 'El documento/RUT es obligatorio',
            'document.string' => 'El documento debe ser una cadena de texto válida',
            'document.min' => 'El documento debe tener al menos 13 caracteres',
            'document.max' => 'El documento no puede exceder los 15 caracteres',
            // 'document.unique' => 'Este documento ya está registrado',
            
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser texto válido',
            'name.max' => 'El nombre no puede exceder los 150 caracteres',
            
            'type.required' => 'El tipo de cliente es obligatorio',
            'type.string' => 'El tipo debe ser texto válido',
            'type.max' => 'El tipo no puede exceder los 50 caracteres',
            
            'city_id.required' => 'Debe seleccionar una ciudad',
            'city_id.exists' => 'La ciudad seleccionada no es válida'
        ];
    }

    public function attributes(): array
    {
        return [
            'document' => 'documento/RUT',
            'name' => 'nombre',
            'type' => 'tipo de cliente',
            'city_id' => 'ciudad'
        ];
    }
}
