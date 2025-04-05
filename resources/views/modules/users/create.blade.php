@extends('layouts.main')

@section('title', 'Crear Usuario')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Crear Nuevo Usuario</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Crear Usuario</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nuevo Usuario</h5>

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Ingrese el nombre completo" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese el correo electrónico" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese una contraseña segura" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="" disabled selected>Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="user">Usuario</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="" disabled selected>Seleccione un estado</option>
                                    <option value="active">Activo</option>
                                    <option value="inactive">Inactivo</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fa-solid fa-check"></i> Guardar
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection