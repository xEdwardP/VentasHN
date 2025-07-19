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
                    </div>
                </div>
            </div>

            <div class="row">
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
        </section>

        <section class="section">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <form method="GET" action="{{ route('home') }}">
                        <div class="p-3 bg-light border rounded shadow-sm mb-4 d-flex flex-wrap align-items-center gap-4">
                            <div class="d-flex align-items-center">
                                <label for="startDate" class="me-2 mb-0 fw-semibold text-secondary">Desde:</label>
                                <input type="date" id="startDate" name="startDate"
                                    value="{{ request('startDate') }}" class="form-control form-control-sm">
                            </div>

                            <div class="d-flex align-items-center">
                                <label for="endDate" class="me-2 mb-0 fw-semibold text-secondary">Hasta:</label>
                                <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}"
                                    class="form-control form-control-sm">
                            </div>

                            <div>
                                <button class="btn btn-info btn-sm d-flex align-items-center" type="submit">
                                    <i class="bi bi-bar-chart me-2"></i> Filtrar
                                </button>
                            </div>

                            <div>
                                <a href="{{ route('home') }}"
                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                    <i class="bi bi-x-circle me-2"></i> Borrar filtros
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ventas por mes</h5>
                            <canvas id="lineChart" style="max-height: 400px;"></canvas>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ventas por país</h5>
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top 5 productos más vendidos</h5>
                            <canvas id="pieChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top 5 usuarios por cantidad de ventas</h5>
                            <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top 5 proveedores por cantidad de productos</h5>
                            <canvas id="barChart2" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Top 5 clientes por cantidad de ventas</h5>
                            <canvas id="barChart3" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categorías más vendidas (RTN vs Sin RTN)</h5>
                            <canvas id="radarChart" style="max-height: 400px;"></canvas>
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const chartColors = {
            background: [
                'rgba(65, 84, 241, 0.7)',
                'rgba(78, 94, 243, 0.7)',
                'rgba(109, 117, 242, 0.7)',
                'rgba(141, 161, 250, 0.7)',
                'rgba(170, 181, 246, 0.7)',
                'rgba(195, 205, 252, 0.7)',
                'rgba(45, 59, 190, 0.7)'
            ],
            border: [
                'rgb(65, 84, 241)',
                'rgb(78, 94, 243)',
                'rgb(109, 117, 242)',
                'rgb(141, 161, 250)',
                'rgb(170, 181, 246)',
                'rgb(195, 205, 252)',
                'rgb(45, 59, 190)'
            ]
        };

        const createChart = ({
            id,
            type,
            labels,
            data,
            label,
            customColors = chartColors,
            showLegend = true,
            options = {}
        }) => {
            const canvas = document.getElementById(id);
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type,
                data: {
                    labels,
                    datasets: [{
                        label,
                        data,
                        backgroundColor: customColors.background,
                        borderColor: customColors.border,
                        borderWidth: 1,
                        fill: type === 'radar',
                        tension: type === 'line' ? 0.1 : undefined,
                        hoverOffset: type === 'pie' || type === 'doughnut' ? 6 : undefined,
                        pointBackgroundColor: type === 'radar' ? customColors.border :
                            undefined
                    }]
                },
                options: Object.assign({
                    responsive: true,
                    scales: type === 'bar' || type === 'line' ? {
                        y: {
                            beginAtZero: true
                        }
                    } : {},
                    plugins: {
                        legend: {
                            display: showLegend,
                            position: type === 'pie' || type === 'doughnut' || type ===
                                'radar' ? 'bottom' : 'top'
                        }
                    },
                    elements: type === 'radar' ? {
                        line: {
                            borderWidth: 2
                        }
                    } : {}
                }, options)
            });
        };

        createChart({
            id: 'lineChart',
            type: 'line',
            labels: {!! json_encode($salesData->pluck('month')) !!},
            data: {!! json_encode($salesData->pluck('total')) !!},
            label: 'Ingresos',
            options: {
                fill: false
            }
        });

        createChart({
            id: 'barChart',
            type: 'bar',
            labels: {!! json_encode($countryLabels) !!},
            data: {!! json_encode($countryValues) !!},
            label: 'Ventas por País'
        });

        createChart({
            id: 'pieChart',
            type: 'pie',
            labels: {!! json_encode($productLabels) !!},
            data: {!! json_encode($productValues) !!},
            label: 'Unidades vendidas',
            customColors: {
                background: [
                    'rgba(65, 84, 241, 0.6)',
                    'rgba(90, 92, 245, 0.6)',
                    'rgba(118, 136, 246, 0.6)',
                    'rgba(167, 180, 250, 0.6)',
                    'rgba(184, 193, 255, 0.6)'
                ],
                border: []
            }
        });

        createChart({
            id: 'doughnutChart',
            type: 'doughnut',
            labels: {!! json_encode($userLabels) !!},
            data: {!! json_encode($userValues) !!},
            label: 'Cantidad de ventas'
        });

        createChart({
            id: 'barChart2',
            type: 'bar',
            labels: {!! json_encode($supplierLabels) !!},
            data: {!! json_encode($supplierValues) !!},
            label: 'Cantidad de productos',
            showLegend: false
        });

        createChart({
            id: 'barChart3',
            type: 'bar',
            labels: {!! json_encode($customerLabels) !!},
            data: {!! json_encode($customerValues) !!},
            label: 'Cantidad de ventas',
            showLegend: false
        });

        const radarChart = document.getElementById('radarChart')?.getContext('2d');
        if (radarChart) {
            new Chart(radarChart, {
                type: 'radar',
                data: {
                    labels: {!! json_encode($radarLabels) !!},
                    datasets: [{
                            label: 'Ventas sin RTN',
                            data: {!! json_encode($radarSinRTN) !!},
                            fill: true,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgb(255, 99, 132)',
                            pointBackgroundColor: 'rgb(255, 99, 132)'
                        },
                        {
                            label: 'Ventas con RTN',
                            data: {!! json_encode($radarConRTN) !!},
                            fill: true,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgb(54, 162, 235)',
                            pointBackgroundColor: 'rgb(54, 162, 235)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    elements: {
                        line: {
                            borderWidth: 2
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        r: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    });
</script>
