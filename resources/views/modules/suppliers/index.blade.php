@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Proveedores</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Proveedores</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div
                            class="card-header bg-light py-3 d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-truck me-2"></i>Proveedores Registrados
                            </h5>
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i>Nuevo Proveedor
                            </a>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 1000px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Nombre</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Contacto
                                            </th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Email</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Sitio Web
                                            </th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Notas</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="fw-medium">{{ $item->name }}</td>

                                                <td class="text-center font-monospace">
                                                    {{ $item->phone }}
                                                </td>

                                                <td class="text-center">
                                                    <a href="mailto:{{ $item->email }}" class="text-lowercase">
                                                        {{ $item->email }}
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ $item->website }}" target="_blank"
                                                        class="text-decoration-none">
                                                        {{ Str::limit(str_replace(['https://', 'http://'], '', $item->website), 20) }}
                                                    </a>
                                                </td>

                                                <td class="text-muted">
                                                    <small>{{ Str::limit($item->notes, 40) }}</small>
                                                </td>

                                                <td class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('suppliers.edit', $item->id) }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                            <i class="bi bi-pencil-square me-1"></i>Editar
                                                        </a>
                                                        <a href="{{ route('suppliers.show', $item->id) }}"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                            <i class="bi bi-trash3 me-1"></i>Eliminar
                                                        </a>
                                                    </div>
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
