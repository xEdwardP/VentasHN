<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'code')->ignore($productId)
            ],
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('products', 'name')->ignore($productId)
            ],
            'description' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0|decimal:0,2',
            'selling_price' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2',
                function ($attribute, $value, $fail) {
                    $purchasePrice = $this->input('purchase_price');
                    if ($value < $purchasePrice) {
                        $fail('El precio de venta debe ser mayor o igual al precio de compra.');
                    }
                }
            ],
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'El código del producto es obligatorio.',
            'code.unique' => 'Este código ya está registrado.',
            'code.max' => 'El código no debe exceder los 255 caracteres.',

            'name.required' => 'El nombre del producto es obligatorio.',
            'name.unique' => 'Este nombre de producto ya existe.',
            'name.max' => 'El nombre no debe exceder los 50 caracteres.',

            'description.max' => 'La descripción no debe exceder los 255 caracteres.',

            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad no puede ser negativa.',

            'purchase_price.required' => 'El precio de compra es obligatorio.',
            'purchase_price.numeric' => 'El precio de compra debe ser un número válido.',
            'purchase_price.min' => 'El precio de compra no puede ser negativo.',
            'purchase_price.decimal' => 'El precio de compra debe tener máximo 2 decimales.',

            'selling_price.required' => 'El precio de venta es obligatorio.',
            'selling_price.numeric' => 'El precio de venta debe ser un número válido.',
            'selling_price.min' => 'El precio de venta no puede ser negativo.',
            'selling_price.decimal' => 'El precio de venta debe tener máximo 2 decimales.',

            'category_id.required' => 'Debe seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no es válida.',

            'supplier_id.required' => 'Debe seleccionar un proveedor.',
            'supplier_id.exists' => 'El proveedor seleccionado no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'code' => 'código de producto',
            'name' => 'nombre de producto',
            'description' => 'descripción',
            'quantity' => 'cantidad',
            'purchase_price' => 'precio de compra',
            'selling_price' => 'precio de venta',
            'category_id' => 'categoría',
            'supplier_id' => 'proveedor'
        ];
    }

    protected function prepareForValidation()
    {
        // Eliminar puntos de miles y convertir comas a puntos para decimales
        if ($this->has('purchase_price')) {
            $this->merge([
                'purchase_price' => (float) str_replace(',', '.', str_replace('.', '', $this->purchase_price))
            ]);
        }

        if ($this->has('selling_price')) {
            $this->merge([
                'selling_price' => (float) str_replace(',', '.', str_replace('.', '', $this->selling_price))
            ]);
        }
    }
}
