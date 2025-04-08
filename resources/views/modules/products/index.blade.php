@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Productos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Productos</li>
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
                                <i class="bi bi-box-seam me-2"></i>Gestión de Productos
                            </h5>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i>Nuevo Producto
                            </a>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 1200px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Código</th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Producto</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Categoría
                                            </th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Proveedor
                                            </th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Stock</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Compra</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Venta</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center fw-medium text-muted">{{ $item->code }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-medium">{{ $item->name }}</span>
                                                        <small
                                                            class="text-muted">{{ Str::limit($item->description, 40) }}</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary py-2 px-3">{{ $item->category_name }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <small class="text-muted">{{ $item->supplier_name }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge {{ $item->quantity > 5 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} p-2">
                                                        {{ $item->quantity }}
                                                    </span>
                                                </td>
                                                <td class="text-center fw-medium text-success">
                                                    L {{ number_format($item->purchase_price, 2) }}</td>
                                                <td class="text-center fw-medium text-danger">
                                                    L {{ number_format($item->selling_price, 2) }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('products.edit', $item->id) }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                            <i class="bi bi-pencil-square"></i> Editar
                                                        </a>
                                                        <a href="{{ route('products.show', $item->id) }}"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                            <i class="bi bi-trash3"></i> Eliminar
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
