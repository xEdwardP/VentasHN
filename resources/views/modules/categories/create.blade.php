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
                                <label for="category_name">Nombre:</label>
                                <input type="text" id="category_name" class="form-control" required name="name" maxlength="150">
                                <button class="btn btn-success mt-3">Guardar</button>
                                <a href="{{ route('categories') }}" class="btn btn-warning mt-3">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
