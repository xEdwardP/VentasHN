@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Productos</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Administar Productos y Stock</h5>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        <span class="d-none d-md-inline">Nuevo Producto</span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 table-responsive">
                                <table class="table table-sm datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Categoria</th>
                                            <th class="text-center">Proveedor</th>
                                            <th class="text-center">Codigo</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Descripcion</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Venta</th>
                                            <th class="text-center">Compra</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->category_name }}</td>
                                                <td>{{ $item->supplier_name }}</td>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">L {{ $item->selling_price }}</td>
                                                <td class="text-center">L {{ $item->purchase_price }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        <span class="d-none d-md-inline">Editar</span>
                                                    </a>
                                                    <a href="{{ route('products.show', $item->id) }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        <span class="d-none d-md-inline">Eliminar</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
