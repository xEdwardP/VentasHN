@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Eliminar Categoría</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">¿Desea eliminar esta categoría?</h5>
                            <form action="{{ route('categories.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <label for="category_name">Nombre:</label>
                                <input type="text" id="category_name" class="form-control" readonly name="name"
                                    value="{{ $item->name }}">
                                <button class="btn btn-danger mt-3">Eliminar</button>
                                <a href="{{ route('categories') }}" class="btn btn-info mt-3">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
