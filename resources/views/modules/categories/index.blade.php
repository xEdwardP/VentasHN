@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Categorias</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categorias Registradas</h5>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        <span class="d-none d-md-inline">Nueva Categoria</span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 table-responsive">
                                <table class="table table-sm datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('categories.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        <span class="d-none d-md-inline">Editar</span>
                                                    </a>
                                                    <a href="{{ route('categories.show', $item->id) }}"
                                                        class="btn btn-danger btn-sm">
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
