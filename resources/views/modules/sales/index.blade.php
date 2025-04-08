@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Venta de Productos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Venta de Productos</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-cart-plus me-2"></i>Seleccionar Productos
                            </h5>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 800px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Código</th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Producto</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Disponible
                                            </th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Precio</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Agregar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td class="text-center fw-medium">{{ $item->code }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span class="fw-medium">{{ $item->name }}</span>
                                                        <small
                                                            class="text-muted">{{ Str::limit($item->description, 40) }}</small>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge bg-primary-subtle text-primary">{{ $item->quantity }}</span>
                                                </td>
                                                <td class="text-center fw-medium text-success">
                                                    L{{ number_format($item->selling_price, 2) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sales.add.cart', $item->id) }}"
                                                        class="btn btn-sm btn-outline-success rounded-pill px-3"
                                                        title="Agregar al carrito">
                                                        <i class="bi bi-plus-lg"></i>
                                                        <span class="d-none d-md-inline">Agregar</span>
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

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-cart-check me-2"></i>Detalle de la Venta
                            </h5>
                        </div>

                        <div class="card-body">
                            @if (session('cartItems'))
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" style="min-width: 800px">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center text-uppercase small text-muted fw-semibold">Código
                                                </th>
                                                <th class="text-start text-uppercase small text-muted fw-semibold">Producto
                                                </th>
                                                <th class="text-center text-uppercase small text-muted fw-semibold">Cantidad
                                                </th>
                                                <th class="text-center text-uppercase small text-muted fw-semibold">P.
                                                    Unitario</th>
                                                <th class="text-center text-uppercase small text-muted fw-semibold">Subtotal
                                                </th>
                                                <th class="text-center text-uppercase small text-muted fw-semibold">Quitar
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = 0; @endphp
                                            @foreach (session('cartItems') as $item)
                                                @php
                                                    $subtotal = $item['quantity'] * $item['price'];
                                                    $total += $subtotal;
                                                @endphp
                                                <tr>
                                                    <td class="text-center fw-medium">{{ $item['code'] }}</td>
                                                    <td class="fw-medium">{{ $item['name'] }}</td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge bg-primary rounded-pill px-3">{{ $item['quantity'] }}</span>
                                                    </td>
                                                    <td class="text-center text-success">
                                                        L{{ number_format($item['price'], 2) }}</td>
                                                    <td class="text-center fw-medium">L{{ number_format($subtotal, 2) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('sales.remove.cart', $item['id']) }}"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                            title="Quitar del carrito">
                                                            <i class="bi bi-dash-lg"></i>
                                                            <span class="d-none d-md-inline">Quitar</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr>
                                                <td colspan="4" class="text-end fw-semibold">Total General:</td>
                                                <td colspan="2" class="text-center fw-bold text-success">
                                                    L{{ number_format($total, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-3">
                                        <form action="{{ route('sales.make.sale') }}" method="POST">
                                            @csrf
                                            {{-- <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                <i class="bi bi-receipt me-2"></i>Finalizar Venta
                                            </button> --}}
                                            <button type="button" class="btn btn-primary rounded-pill px-4"
                                                data-bs-toggle="modal" data-bs-target="#makeSaleModal">
                                                <i class="bi bi-receipt me-2"></i>Finalizar Venta
                                            </button>
                                        </form>
                                        <a href="{{ route('sales.delete.cart') }}"
                                            class="btn btn-outline-danger rounded-pill px-4">
                                            <i class="bi bi-trash3 me-2"></i>Vaciar Carrito
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-cart-x text-muted" style="font-size: 3rem"></i>
                                    <p class="text-muted mt-3">No hay productos en el carrito</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    @include('partials.locations')
    @if (session('cartItems'))
        @include('modules.sales.modal_make_sale')
    @endif
    <script>
        $(document).ready(function() {
            $('#cartProducts').DataTable({
                "pageLength": 2,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        })
    </script>
@endpush
