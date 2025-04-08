@extends('layouts.main')

@section('title', $title)

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Panel de Datos</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        {{-- Botones de selección --}}
                        <div class="row mb-4 text-center">
                            @php
                                $buttons = [
                                    ['Ventas', 'salesChart', 'success', 'chart-bar'],
                                    ['Productos', 'productsChart', 'warning', 'box'],
                                    ['Clientes', 'customersChart', 'info', 'users'],
                                    ['Proveedores', 'providersChart', 'danger', 'truck'],
                                    ['Categorías', 'categoriesChart', 'primary', 'tags'],
                                ];
                            @endphp
                            @foreach($buttons as [$label, $chart, $color, $icon])
                                <div class="col-6 col-md-3 mb-2">
                                    <button class="btn btn-{{ $color }} w-100 show-chart" data-chart="{{ $chart }}">
                                        <i class="fa-solid fa-{{ $icon }}"></i> {{ $label }}
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        {{-- Botón de exportación --}}
                        <div class="text-center export-btn mb-4">
                            <button class="btn btn-outline-secondary w-100 w-md-50" id="exportChartBtn">
                                <i class="fa-solid fa-download"></i> Exportar gráfico como PNG
                            </button>
                        </div>

                        {{-- Contenedores de gráficos --}}
                        <div id="salesChartContainer" class="chart-container">
                            <h2 class="chart-title text-center">Gráfico de Ventas</h2>
                            <canvas id="salesChart"></canvas>
                        </div>
                        <div id="productsChartContainer" class="chart-container d-none">
                            <h2 class="chart-title text-center">Gráfico de Productos</h2>
                            <canvas id="productsChart"></canvas>
                        </div>
                        <div id="customersChartContainer" class="chart-container d-none">
                            <h2 class="chart-title text-center">Gráfico de Clientes</h2>
                            <canvas id="customersChart"></canvas>
                        </div>
                        <div id="providersChartContainer" class="chart-container d-none">
                            <h2 class="chart-title text-center">Gráfico de Proveedores</h2>
                            <canvas id="providersChart"></canvas>
                        </div>
                        <div id="categoriesChartContainer" class="chart-container d-none">
                            <h2 class="chart-title text-center">Gráfico de Categorías</h2>
                            <canvas id="categoriesChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

{{-- Estilos --}}
<style>
    .chart-container {
        width: 100%;
        max-width: 700px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    canvas {
        width: 100% !important;
        height: auto !important;
        max-height: 400px;
    }

    .chart-title {
        font-weight: 600;
        margin-bottom: 20px;
    }

    .export-btn {
        margin-bottom: 20px;
    }

    @media (max-width: 576px) {
        .chart-title {
            font-size: 1.1rem;
        }

        .btn {
            font-size: 0.9rem;
            padding: 10px;
        }
    }
</style>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll('.show-chart');
        const charts = document.querySelectorAll('.chart-container');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                charts.forEach(chart => chart.classList.add('d-none'));
                const targetChart = document.getElementById(this.dataset.chart + "Container");
                targetChart.classList.remove('d-none');
            });
        });

        const sale_detailsData = @json($sales);
        const productsData = @json($products);
        const customersData = @json($customers);
        const suppliersData = @json($suppliers);
        const categoriesData = @json($categories);

        const chartConfigs = {
            salesChart: {
                type: 'bar',
                data: {
                    labels: sale_detailsData.map(item => item.product_name),
                    datasets: [{
                        label: 'Cantidad de Ventas',
                        data: sale_detailsData.map(item => item.total_sales),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                }
            },
            productsChart: {
                type: 'pie',
                data: {
                    labels: productsData.map(item => item.name),
                    datasets: [{
                        label: 'Cantidad de Productos',
                        data: productsData.map(item => item.quantity),
                        backgroundColor: ['#7FB3D5', '#F7DC6F', '#82E0AA', '#F1948A', '#BB8FCE']
                    }]
                }
            },
            customersChart: {
                type: 'line',
                data: {
                    labels: customersData.map(item => item.name),
                    datasets: [{
                        label: 'Clientes Registrados',
                        data: customersData.map(item => item.name.length),
                        borderColor: '#3498DB',
                        backgroundColor: 'rgba(52, 152, 219, 0.2)',
                        fill: true,
                        tension: 0.3
                    }]
                }
            },
            providersChart: {
                type: 'doughnut',
                data: {
                    labels: suppliersData.map(item => item.name),
                    datasets: [{
                        label: 'Proveedores',
                        data: suppliersData.map(item => item.notes.length),
                        backgroundColor: ['#F1948A', '#58D68D', '#5DADE2', '#F5B041', '#BB8FCE']
                    }]
                }
            },
            categoriesChart: {
                type: 'bar',
                data: {
                    labels: categoriesData.map(item => item.name),
                    datasets: [{
                        label: 'Categorías por Usuario',
                        data: categoriesData.map(item => item.user_id),
                        backgroundColor: '#85C1E9',
                        borderColor: '#2E86C1',
                        borderWidth: 1
                    }]
                }
            }
        };

        for (const [chartId, config] of Object.entries(chartConfigs)) {
            const ctx = document.getElementById(chartId).getContext('2d');
            new Chart(ctx, config);
        }

        document.getElementById('exportChartBtn').addEventListener('click', function () {
            const visibleChart = document.querySelector('.chart-container:not(.d-none) canvas');
            if (!visibleChart) return alert('No hay gráfico visible para exportar.');

            const title = visibleChart.closest('.chart-container').querySelector('h2')?.innerText || 'grafico';
            const fileName = title.toLowerCase().replace(/\s+/g, '_') + '.png';

            const link = document.createElement('a');
            link.download = fileName;
            link.href = visibleChart.toDataURL('image/png');
            link.click();
        });
    });
</script>
@endsection
