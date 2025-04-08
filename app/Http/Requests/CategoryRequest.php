<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150', 'unique:categories,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto válida',
            'name.max' => 'El nombre no puede exceder los :max caracteres',
            'name.unique' => 'Esta categoría ya existe en el sistema',
        ];
    }

    public function attributes(): array
    {
        return
            [
                'name' => 'nombre de categoría',
            ];
    }
}
