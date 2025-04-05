@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Proveedores</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Proveedores Registrados</h5>
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuevo Proveedor
                            </a>
                            <hr>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Sitio web</th>
                                        <th class="text-center">Nota</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->website }}</td>
                                            <td>{{ $item->notes }}</td>
                                            <td>
                                                <a href="{{ route('suppliers.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>Editar
                                                </a>
                                                <a href="{{ route('suppliers.show', $item->id) }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash-can"></i>Eliminar
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
        </section>
    </main>
@endsection
