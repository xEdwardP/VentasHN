@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detalle de la venta</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detalle de la venta</h5>
                            <p><strong>Usuario que hizo la venta: </strong> {{ $sale->user_name }} </p>
                            <p><strong>Total de venta:</strong> L {{ $sale->total }}</p>
                            <p><strong>Fecha: </strong>{{ $sale->created_at }}</p>
                            <hr>
                            <table class="table table-sm datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Precio Unitario</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $item)
                                    <tr class="text-center">
                                      <td class="text-center">{{ $item->product_name }}</td>
                                      <td class="text-center">{{ $item->quantity }}</td>
                                      <td class="text-center">L {{ $item->unit_price }}</td>
                                      <td class="text-center">L {{ $item->subtotal }}</td>
                                     
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <a href="{{ route('sale-details') }}" class="btn btn-info">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
