@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Reportes de Ventas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Reportes de Ventas</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light py-3 border-bottom">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-funnel me-2"></i>Filtros de Búsqueda
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('sales-reports') }}" method="GET">
                                <div class="row g-3">
                                    <!-- Fechas -->
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="date" name="desde" id="desde" class="form-control"
                                                placeholder="Fecha inicial">
                                            <label for="desde">Fecha Desde</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="date" name="hasta" id="hasta" class="form-control"
                                                placeholder="Fecha final">
                                            <label for="hasta">Fecha Hasta</label>
                                        </div>
                                    </div>

                                    <!-- Producto -->
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="producto" id="producto" class="form-control"
                                                placeholder="Buscar producto">
                                            <label for="producto">Producto</label>
                                        </div>
                                    </div>

                                    <!-- Ubicación -->
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select name="pais" id="pais" class="form-select">
                                                <option value="">Seleccione</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="pais">País</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select name="estado" id="estado" class="form-select" disabled>
                                                <option value="">Seleccione</option>
                                            </select>
                                            <label for="estado">Departamento/Estado</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select name="ciudad" id="ciudad" class="form-select" disabled>
                                                <option value="">Seleccione</option>
                                            </select>
                                            <label for="ciudad">Ciudad</label>
                                        </div>
                                    </div>

                                    <!-- Botones -->
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill">
                                            <i class="bi bi-search me-2"></i>Filtrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div
                            class="card-header bg-light py-3 border-bottom d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-receipt me-2"></i>Resultados de Ventas
                            </h5>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle datatable" style="min-width: 1200px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold"># Venta</th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Cliente</th>
                                            <th class="text-start text-uppercase small text-muted fw-semibold">Producto</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Total</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Fecha</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Usuario</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Ubicación
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $venta)
                                            <tr>
                                                <td class="text-center fw-medium">{{ $venta->id }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-medium">{{ $venta->customer_name ?? 'Cliente no registrado' }}</span>
                                                        @if ($venta->customer_rtn)
                                                            <small class="text-muted">RTN:
                                                                {{ $venta->customer_rtn }}</small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $venta->product_name }}</td>
                                                <td class="text-center fw-bold text-success">
                                                    L{{ number_format($venta->total, 2) }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark">
                                                        {{ $venta->created_at->format('d/m/Y h:i A') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">{{ $venta->user_name }}</td>
                                                <td class="text-center">
                                                    <small class="text-muted">
                                                        {{ $venta->city }}, {{ $venta->state }}<br>
                                                        {{ $venta->country }}
                                                    </small>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Carga dinámica de estados
            $('#pais').on('change', function() {
                const countryId = $(this).val();
                $('#estado').html('<option value="">Cargando...</option>').prop('disabled', true);
                $('#ciudad').html('<option value="">Seleccione primero un estado</option>').prop('disabled',
                    true);

                if (countryId) {
                    $.get(`/get-states/${countryId}`, function(data) {
                        let options = '<option value="">Seleccione</option>';
                        data.forEach(state => {
                            options += `<option value="${state.id}">${state.name}</option>`;
                        });
                        $('#estado').html(options).prop('disabled', false);
                    });
                }
            });

            // Carga dinámica de ciudades
            $('#estado').on('change', function() {
                const stateId = $(this).val();
                $('#ciudad').html('<option value="">Cargando...</option>').prop('disabled', true);

                if (stateId) {
                    $.get(`/get-cities/${stateId}`, function(data) {
                        let options = '<option value="">Seleccione</option>';
                        data.forEach(city => {
                            options += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#ciudad').html(options).prop('disabled', false);
                    });
                }
            });
        });
    </script>
@endpush
