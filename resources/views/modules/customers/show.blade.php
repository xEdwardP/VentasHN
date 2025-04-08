@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Eliminar Clientes</h1>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Eliminar Cliente</h5>
                          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Documento</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Tipo de Cliente</th>
                                        <th class="text-center">País</th>
                                        <th class="text-center">Ciudad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items)
                                        <tr class="text-center">
                                            <td>{{ $items->document }}</td>
                                            <td>{{ $items->name }}</td>
                                            <td>{{ $items->type }}</td>
                                            <td>{{ $items->city->state->country->name ?? 'No disponible' }}</td>
                                            <td>{{ $items->city->name ?? 'No disponible' }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No hay datos disponibles</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <hr>

                            @if ($items)
                                <form action="{{ route('customers.destroy', $items->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Eliminar Cliente</button>
                                    <a href="{{ route('customers') }}" class="btn btn-info">Cancelar</a>
                                </form>
                            @else
                                <a href="{{ route('customers') }}" class="btn btn-info">Volver</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection