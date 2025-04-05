@extends('layouts.main')

@section('title', 'Usuarios')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Usuarios</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Administrar Usuarios</h5>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start mb-3">
                                <a href="{{ route('users.create') }}" class="btn btn-primary me-2">
                                    <i class="fa-solid fa-circle-plus"></i> Crear
                                </a>
                            </div>
                        </div>
                        <hr>

                        <div class="col-12 table-responsive">
                            <table id="example" class="table table-sm datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Correo</th>
                                        <th class="text-center">Rol</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users && $users->count() > 0)
                                        @foreach ($users as $user)
                                            <tr class="text-center">
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No hay usuarios registrados.</td>
                                        </tr>
                                    @endif
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