@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Usuarios</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Administar</h5>
                            {{-- Encabezado --}}
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a href="#" class="btn btn-primary">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        <span class="d-none d-md-inline">Nuevo</span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            {{-- tabla --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
