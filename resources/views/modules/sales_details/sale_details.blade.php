@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detalle de Venta</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sale-details') }}">Ventas</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-receipt me-2"></i>Información de la Venta
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="text-muted small">VENDEDOR</h6>
                                        <p class="mb-0 fw-medium">{{ $sale->user_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="text-muted small">TOTAL</h6>
                                        <p class="mb-0 fw-bold text-success">L{{ number_format($sale->total, 2) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded">
                                        <h6 class="text-muted small">FECHA</h6>
                                        <p class="mb-0">{{ $sale->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle" style="min-width: 800px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Producto</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Cantidad</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">P. Unitario</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $item->product_name }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-primary rounded-pill px-3">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-center text-success">L{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="text-center fw-bold">L{{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="3" class="text-end fw-semibold">Total General:</td>
                                            <td class="text-center fw-bold text-success">L{{ number_format($sale->total, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('detail.ticket', $sale->id) }}" target="_blank" 
                                   class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="bi bi-printer me-2"></i>Imprimir Ticket
                                </a>
                                <a href="{{ route('sale-details') }}" 
                                   class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Volver a Ventas
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection