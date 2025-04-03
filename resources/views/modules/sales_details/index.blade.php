@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Consulta de ventas hecha</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Revisar Ventas Existentes</h5>
                            <hr>
                            <div class="col-12 table-responsive">
                                <table class="table table-sm datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Total Vendido</th>
                                            <th class="text-center">Fecha Venta</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Ver Detalle</th>
                                            <th class="text-center">Imprimir Ticket</th>
                                            <th class="text-center">Revocar Venta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr class="text-center">
                                                <td class="text-center">L {{ $item->total }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                                <td class="text-center">{{ $item->user_name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('detail.view.detail', $item->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fa-solid fa-file-lines"></i><span class="d-none d-md-inline"> Detalle</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ route('detail.ticket', $item->id) }}" class="btn btn-success btn-sm">
                                                        {{-- <i class="fa-solid fa-receipt"></i> --}}
                                                        <i class="fa-solid fa-print"></i><span class="d-none d-md-inline"> Imprimir</span>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('detail.revoke', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('¿Esta seguro de revocar la venta?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-ban"></i><span class="d-none d-md-inline"> Revocar</span>
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