@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Ventas Totales</h5>
                                            <h2 class="mb-0">{{ $quantitySales }}</h2>
                                        </div>
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="bi bi-cart-check fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3" style="height: 25px">
                                        {{-- <span class="text-success small"><i class="bi bi-arrow-up"></i> 12% último
                                            mes</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Ingresos</h5>
                                            <h2 class="mb-0">L{{ number_format($totalSales, 2) }}</h2>
                                        </div>
                                        <div class="icon-circle bg-success text-white">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3" style="height: 25px">
                                        {{-- <span class="text-danger small"><i class="bi bi-arrow-down"></i> 5% último
                                            mes</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card customers-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Productos con Bajo
                                                Stock</h5>
                                            <h2 class="mb-0">{{ count($productsMinStock) }}</h2>
                                        </div>
                                        <div class="icon-circle bg-warning text-dark">
                                            <i class="bi bi-exclamation-triangle fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-3" style="height: 4px;">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ min(count($productsMinStock), 100) }}%"
                                            aria-valuenow="{{ count($productsMinStock) }}" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Costos de Operación -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card operating-costs-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Costos de Operación
                                            </h5>
                                            <h2 class="mb-0">L{{ number_format($operatingCosts, 2) }}</h2>
                                        </div>
                                        <div class="icon-circle bg-danger text-white">
                                            <i class="bi bi-cash-coin fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <span class="text-muted small">Acumulado histórico</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ganancia Neta -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card net-profit-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Ganancia Neta</h5>
                                            <h2 class="mb-0">L{{ number_format($netProfit, 2) }}</h2>
                                        </div>
                                        <div class="icon-circle bg-info text-white">
                                            <i class="bi bi-graph-up fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @php $percentage = ($totalSales != 0) ? round(($netProfit / $totalSales) * 100, 2) : 0; @endphp
                                        <span class="{{ $percentage >= 0 ? 'text-success' : 'text-danger' }} small">
                                            <i class="bi bi-arrow-{{ $percentage >= 0 ? 'up' : 'down' }}"></i>
                                            {{ $percentage }}% Margen
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Unidades Vendidas -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card units-card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-muted text-uppercase small mb-2">Unidades Vendidas
                                            </h5>
                                            <h2 class="mb-0">{{ number_format($unitsSold) }}</h2>
                                        </div>
                                        <div class="icon-circle bg-secondary text-white">
                                            <i class="bi bi-box-seam fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @php
                                            $avgUnits = $quantitySales > 0 ? round($unitsSold / $quantitySales, 1) : 0;
                                        @endphp
                                        <span class="text-primary small">
                                            {{ $avgUnits }} unidades por venta
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="card-title mb-0">Ventas Recientes</h5>
                                        <a href="{{ route('sale-details') }}" class="btn btn-sm btn-outline-primary">
                                            Ver Todas <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center text-uppercase small text-muted">#ID</th>
                                                    <th class="text-center text-uppercase small text-muted">Total</th>
                                                    <th class="text-center text-uppercase small text-muted">Fecha</th>
                                                    <th class="text-center text-uppercase small text-muted">Usuario</th>
                                                    <th class="text-center text-uppercase small text-muted">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentProducts as $item)
                                                    <tr>
                                                        <td class="text-center fw-medium">#{{ $item->id }}</td>
                                                        <td class="text-center text-success fw-medium">
                                                            L{{ number_format($item->total, 2) }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->created_at->format('d M Y H:i') }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-primary-subtle text-primary">
                                                                {{ $item->user_name }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('detail.view.detail', $item->id) }}"
                                                                class="btn btn-sm btn-outline-info">
                                                                <i class="bi bi-eye"></i>
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
                </div>
            </div>
        </section>
    </main>

    <style>
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .card:hover .icon-circle {
            transform: scale(1.1);
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 2px;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
