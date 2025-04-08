@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Clientes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                                <i class="bi bi-people-fill me-2"></i>Administración de Clientes
                            </h5>
                            <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm rounded-pill">
                                <i class="bi bi-person-add me-2"></i>Nuevo Cliente
                            </a>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 1000px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Documento
                                            </th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Nombre</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Tipo</th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Ubicación
                                            </th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="fw-medium text-center">{{ $item->document }}</td>

                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-medium">{{ $item->name }}</span>
                                                        <small class="text-muted">Cliente desde:
                                                            {{ $item->created_at->format('d/m/Y') }}</small>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                        {{ $item->type }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="small">{{ $item->city->name ?? 'N/A' }}</span>
                                                        <span class="small text-muted">
                                                            {{ $item->city->state->name ?? 'N/A' }},
                                                            {{ $item->city->state->country->name ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('customers.edit', $item->document) }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                            title="Editar cliente">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="d-none d-md-inline">Editar</span>
                                                        </a>
                                                        <a href="{{ route('customers.show', $item->document) }}"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                            title="Eliminar cliente">
                                                            <i class="bi bi-trash3"></i>
                                                            <span class="d-none d-md-inline">Eliminar</span>
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
