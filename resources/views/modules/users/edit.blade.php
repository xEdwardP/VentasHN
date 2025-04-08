@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Editar Usuario</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar Usuario</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editar Usuario</h5>
                            <form action="{{ route('users.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre</strong></small></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $item->name }}" maxlength="255" required autofocus>
                                        <x-error field="name" class="mt-1" />
                                    </div>

                                    <div class="col-3 mt-1">
                                        <label for="rol"><small><strong>Rol</strong></small></label>
                                        <select name="rol" id="rol" class="form-select" required>
                                            <option value="">Selecciona el rol</option>
                                            @if ($item->rol == 'admin')
                                                <option value="admin" selected>Admin</option>
                                                <option value="cajero">Cajero</option>
                                            @else
                                                <option value="admin">Admin</option>
                                                <option value="cajero" selected>Cajero</option>
                                            @endif
                                        </select>
                                        <x-error field="rol" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="email"><small><strong>Email</strong></small></label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ $item->email }}" maxlength="255" required>
                                        <x-error field="email" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-warning mt-3">Actualizar</button>
                                        <a href="{{ route('users') }}" class="btn btn-info mt-3">
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
