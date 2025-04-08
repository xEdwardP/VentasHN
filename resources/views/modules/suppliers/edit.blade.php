@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Editar Proveedor</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Proveedor</h5>
                            <form action="{{ route('suppliers.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-9 mt-1">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" required name="name" id="name" maxlength="150"
                                            value="{{ $item->name }}">
                                    </div>
                                    <div class="col-3 mt-1">
                                        <label for="phone">Teléfono</label>
                                        <input type="text" class="form-control" required name="phone" id="phone" maxlength="12"
                                            value="{{ $item->phone }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mt-1">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" required name="email" id="email" maxlength="255"
                                            value="{{ $item->email }}">
                                    </div>
                                    <div class="col-6 mt-1">
                                        <label for="website">Sitio Web</label>
                                        <input type="text" class="form-control" required name="website" id="website" maxlength="150"
                                            value="{{ $item->website }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="notes">Notas</label>
                                        <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" maxlength="255">{{ $item->notes }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-warning mt-3">Actualizar</button>
                                        <a href="{{ route('suppliers') }}" class="btn btn-info mt-3">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
