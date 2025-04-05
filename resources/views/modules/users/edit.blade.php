@extends('layouts.main')

@section('title', 'Editar Usuario')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Editar Usuario</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Editar Usuario</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Usuario</h5>

                        
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Opcional">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fa-solid fa-check"></i> Actualizar
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