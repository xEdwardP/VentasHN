@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Crear Nuevo Usuario</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Crear Usuario</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Agregar Nuevo Usuario</h5>
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre</strong></small></label>
                                        <input type="text" class="form-control"  name="name" id="name"
                                            maxlength="255" required autofocus>
                                        <x-error field="name" class="mt-1" />
                                    </div>
                                    <div class="col-3 mt-1">
                                        <label for="rol"><small><strong>Rol</strong></small></label>
                                        <select name="rol" id="rol" class="form-select" required>
                                            <option value="">Selecciona el rol</option>
                                            <option value="admin">Admin</option>
                                            <option value="cajero">Cajero</option>
                                        </select>
                                        <x-error field="rol" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="email"><small><strong>Email</strong></small></label>
                                        <input type="text" name="email" id="email" class="form-control" 
                                            maxlength="255" required>
                                        <x-error field="email" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="password"><small><strong>Password</strong></small></label>
                                        <input type="password" name="password" id="password" class="form-control" 
                                            maxlength="255" required>
                                        <x-error field="password" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-success mt-3">Guardar</button>
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
