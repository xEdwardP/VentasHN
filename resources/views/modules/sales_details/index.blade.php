@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Consulta de Ventas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Consulta de Ventas</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-receipt me-2"></i>Historial de Ventas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 800px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Total Vendido</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Fecha Venta</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Usuario</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Ver Detalle</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Imprimir Ticket</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Revocar Venta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center fw-bold text-success">
                                                    L{{ number_format($item->total, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        {{ $item->user_name }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('detail.view.detail', $item->id) }}"
                                                        class="btn btn-sm btn-outline-info rounded-pill px-3"
                                                        title="Ver detalle">
                                                        <i class="bi bi-file-text"></i>
                                                        <span class="d-none d-md-inline"> Detalle</span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a target="_blank" href="{{ route('detail.ticket', $item->id) }}" 
                                                        class="btn btn-sm btn-outline-success rounded-pill px-3"
                                                        title="Imprimir ticket">
                                                        <i class="bi bi-printer"></i>
                                                        <span class="d-none d-md-inline"> Imprimir</span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('detail.revoke', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('¿Está seguro de revocar esta venta?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                            title="Revocar venta">
                                                            <i class="bi bi-x-circle"></i>
                                                            <span class="d-none d-md-inline"> Revocar</span>
                                                        </button>
                                                    </form>
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