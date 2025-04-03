@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Editar Cliente</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Cliente</h5>
                            <form action="{{ route('customers.update', $item->document) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-6 m-1">
                                        <label for="document"><small><strong>Documento</strong></small></label>
                                        <input type="text" class="form-control" id="document" name="document"
                                            value="{{ $item->document }}">
                                    </div>

                                    <div class="col-6 mt-1">
                                        <label for="name"><small><strong>Nombre del Cliente</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name"
                                            value="{{ $item->name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="type"><small><strong>Tipo de Cliente</strong></small></label>
                                        <textarea name="type" id="type" cols="20" rows="5" class="form-control">{{ $item->type }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <label for="country"><small><strong>Pais</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="country"
                                            value="{{ $item->country }}" name="country" required maxlength="10">
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="city"><small><strong>Ciudad</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="city"
                                            value="{{ $item->city}}" name="city" required
                                            maxlength="12">
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-warning mt-3">Actualizar</button>
                                        <a href="{{ route('customers') }}" class="btn btn-info mt-3">
                                            Cancelar
                                        </a>
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
