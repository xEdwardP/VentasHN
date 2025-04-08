@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Editar Producto</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Producto</h5>
                            <form action="{{ route('products.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-3 mt-1">
                                        <label for="code"><small><strong>Codigo</strong></small></label>
                                        <input type="text" class="form-control" id="code" name="code"
                                            value="{{ $item->code }}" maxlength="255" required readonly>
                                        <x-error field="code" class="mt-1" />
                                    </div>

                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre del producto</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name"
                                            value="{{ $item->name }}" autofocus>
                                        <x-error field="name" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="description"><small><strong>Descripción</strong></small></label>
                                        <textarea name="description" id="description" cols="20" rows="5" class="form-control">{{ $item->description }}</textarea>
                                        <x-error field="description" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <label for="quantity"><small><strong>Cantidad</strong></small></label>
                                        <input type="number" class="form-control form-control-sm" id="quantity"
                                            value="{{ $item->quantity }}" name="quantity" required maxlength="10">
                                        <x-error field="quantity" class="mt-1" />
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="purchase_price"><small><strong>Precio Compra</strong></small></label>
                                        <input type="number" class="form-control form-control-sm" id="purchase_price"
                                            value="{{ $item->purchase_price }}" name="purchase_price" required
                                            maxlength="12">
                                        <x-error field="purchase_price" class="mt-1" />
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="selling_price"><small><strong>Precio de venta</strong></small></label>
                                        <input type="text" id="selling_price" name="selling_price"
                                            class="form-control form-control-sm" value="{{ $item->selling_price }}" required
                                            maxlength="12">
                                        <x-error field="selling_price" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mt-1">
                                        <label for="category_id"><small><strong>Categoria</strong></small></label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="">Selecciona una categoria</option>
                                            @foreach ($categories as $category)
                                                @if ($item->category_id == $category->id)
                                                    <option selected value="{{ $category->id }}"> {{ $category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-error field="category_id" class="mt-1" />
                                    </div>

                                    <div class="col-6 mt-1">
                                        <label for="supplier_id"><small><strong>Proveedor</strong></small></label>
                                        <select name="supplier_id" id="supplier_id" class="form-select" required>
                                            <option value="">Selecciona un proveedor</option>
                                            @foreach ($suppliers as $supplier)
                                                @if ($item->supplier_id == $supplier->id)
                                                    <option selected value="{{ $supplier->id }}"> {{ $supplier->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $supplier->id }}"> {{ $supplier->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <x-error field="supplier_id" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-warning mt-3">Actualizar</button>
                                        <a href="{{ route('products') }}" class="btn btn-info mt-3">
                                            Cancelar
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
