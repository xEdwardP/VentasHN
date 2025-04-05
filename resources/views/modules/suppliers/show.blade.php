@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Eliminar Proveedor</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">¿Desea eliminar este proveedor?</h5>
                            <p>
                                Una vez eliminado el proveedor no podra ser recuperado.
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Sitio web</th>
                                        <th class="text-center">Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->website }}</td>
                                        <td>{{ $item->notes }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <form action="{{ route('suppliers.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mt-3">Eliminar</button>
                                <a href="{{ route('suppliers') }}" class="btn btn-info mt-3">
                                    Cancelar
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection