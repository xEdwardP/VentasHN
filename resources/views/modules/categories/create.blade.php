@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Registrar Nueva Categoria</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos de la Categoria</h5>
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <label for="category_name">Nombre:</label>
                                        <input type="text" id="category_name" class="form-control" name="name" maxlength="150" autofocus required>
                                        <x-error field="name" class="mt-1"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-1">
                                        <button class="btn btn-outline-success mt-2">Guardar</button>
                                        <a href="{{ route('categories') }}" class="btn btn-outline-warning mt-2">Cancelar</a>
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
