@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Clientes</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Administrar Clientes</h5>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        <span class="d-none d-md-inline">Nuevo Cliente</span>
                                    </a>
                                </div>
                            </div>

                            <hr>

                            <div class="col-12 table-responsive">
                                <table class="table table-sm datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Documento</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Tipo de Cliente</th>
                                            <th class="text-center">País</th>
                                            <th class="text-center">Ciudad</th>
                                            <th class="text-center">Acciones</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr class="text-center">
                                                <td class="text-center">{{ $item->document }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>{{ $item->country }}</td>
                                                <td>{{ $item->city }}</td>
                                                <td>
                                                    <a href="{{ route('customers.edit', $item->document) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        <span class="d-none d-md-inline">Editar</span>
                                                    </a>
                                                    <a href="{{ route('customers.show', $item->document) }}"
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
