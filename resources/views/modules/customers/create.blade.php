@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registrar Nuevo Cliente</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Cliente</h5>
                            <form action="{{ route('customers.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-3 mt-1">
                                        <label for="document"><small><strong>DNI</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="document"
                                            name="document" maxlength="255">
                                    </div>

                                    <div class="col-9 mt-1">
                                        <label for="name"><small><strong>Nombre del cliente</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" required name="name"
                                            id="name" maxlength="50">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="type"><small><strong>Tipo de Cliente</strong></small></label>
                                        <textarea name="type" id="type" cols="20" rows="1" class="form-control form-control-sm"
                                            maxlength="50"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 mt-1">
                                        <label for="country"><small><strong>Ciudad</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="country"
                                            name="country" required maxlength="10">
                                    </div>
                                    <div class="col-4 mt-1">
                                        <label for="city"><small><strong>Pais</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="city"
                                            name="city" required maxlength="12">
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-12 my-3 mt-1">
                                        <hr>
                                        <button class="btn btn-success btn-sm mt-1">Guardar</button>
                                        <a href="{{ route('customers') }}" class="btn btn-warning btn-sm mt-1">Cancelar</a>
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
