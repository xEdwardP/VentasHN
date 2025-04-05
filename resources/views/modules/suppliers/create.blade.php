@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registrar Nuevo Proveedor</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Proveedor</h5>
                            <form action="{{ route('suppliers.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name" maxlength="150">
                                    </div>

                                    <div class="col-3 mt-1">
                                        <label for="phone"><small><strong>Teléfono</strong></small></label>
                                        <input type="text" class="form-control" required name="phone" id="phone"
                                            maxlength="12">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mt-1">
                                        <label for="email"><small><strong>Email</strong></small></label>
                                        <input type="email" class="form-control" required name="email" id="email" maxlength="255">
                                    </div>

                                    <div class="col-6 mt-1">
                                        <label for="website"><small><strong>Sitio Web</strong></small></label>
                                        <input type="text" class="form-control" required name="website" id="website" maxlength="150">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="notes"><small><strong>Notas</strong></small></label>
                                        <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" maxlength="255"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-success mt-3">Guardar</button>
                                        <a href="{{ route('suppliers') }}" class="btn btn-warning mt-3">Cancelar</a>
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
