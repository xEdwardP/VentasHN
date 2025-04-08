@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registrar Nuevo Producto</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Producto</h5>
                            <form action="{{ route('products.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-3 mt-1">
                                        <label for="code"><small><strong>Codigo</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="code"
                                            name="code" maxlength="255" required autofocus value="{{ old('code') }}">
                                        <x-error field="code" class="mt-1" />
                                    </div>

                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre del producto</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" required name="name"
                                            id="name" maxlength="50" value="{{ old('name') }}">
                                        <x-error field="name" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="description"><small><strong>Descripción</strong></small></label>
                                        <textarea name="description" id="description" cols="20" rows="5" class="form-control form-control-sm"
                                            maxlength="2505">{{ old('description') }}</textarea>
                                        <x-error field="description" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <label for="quantity"><small><strong>Cantidad</strong></small></label>
                                        <input type="number" class="form-control form-control-sm" id="quantity"
                                            name="quantity" required maxlength="10" value="{{ old('quantity') }}">
                                        <x-error field="quantity" class="mt-1" />
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="purchase_price"><small><strong>Precio Compra</strong></small></label>
                                        <input type="number" class="form-control form-control-sm" id="purchase_price"
                                            name="purchase_price" required maxlength="12" value="{{ old('purchase_price') }}">
                                        <x-error field="purchase_price" class="mt-1" />
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="selling_price"><small><strong>Precio Venta</strong></small></label>
                                        <input type="number" class="form-control form-control-sm" id="selling_price"
                                            name="selling_price" required maxlength="12" value="{{ old('selling_price') }}">
                                        <x-error field="selling_price" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mt-1">
                                        <label for="category_id"><small><strong>Categoria</strong></small></label>
                                        <select name="category_id" id="category_id"
                                            class="form-select form-control form-control-sm" required maxlength="150">
                                            <option value="">Selecciona una categoria</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-error field="category_id" class="mt-1" />
                                    </div>

                                    <div class="col-6 mt-1">
                                        <label for="supplier_id"><small><strong>Proveedor</strong></small></label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-select form-control form-control-sm" required maxlength="150">
                                            <option value="">Selecciona un proveedor</option>
                                            @foreach ($suppliers as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                        <x-error field="supplier_id" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 my-3 mt-1">
                                        <hr>
                                        <button class="btn btn-success btn-sm mt-1">Guardar</button>
                                        <a href="{{ route('products') }}" class="btn btn-warning btn-sm mt-1">Cancelar</a>
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
