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
                                    <div class="col-3 mt-2">
                                        <label for="document"><small><strong>DOCUMENTO</strong></small></label>
                                        <input type="text" class="form-control" id="document" name="document"
                                            minlength="13" maxlength="15" required autofocus
                                            placeholder="Ejemplo: 0801199901234">
                                        <x-error field="document" class="mt-1" />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <label for="name"><small><strong>Nombre del cliente</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name"
                                            maxlength="150">
                                        <x-error field="name" class="mt-1" />
                                    </div>

                                    <div class="col-3 mt-2">
                                        <label for="type"><small><strong>Tipo de Cliente</strong></small></label>
                                        <select class="form-select form-control" id="type" name="type" required>
                                            <option value="">Seleccione el tipo</option>
                                            <option value="mayorista"
                                                {{ old('type', $item->type ?? '') == 'mayorista' ? 'selected' : '' }}>
                                                Mayorista</option>
                                            <option value="minorista"
                                                {{ old('type', $item->type ?? '') == 'minorista' ? 'selected' : '' }}>
                                                Minorista</option>
                                        </select>
                                        <x-error field="type" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 mt-2">
                                        <label for="" class="my-0"><small><strong>PAIS</strong></small></label>
                                        <select name="country_id" id="country" class="form-select" required>
                                            <option value="">SELECCIONE EL PAIS</option>
                                            @foreach ($countries as $country)
                                                {{-- <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}> --}}
                                                <option value="{{ $country->id }}" {{ old('country_id') }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-error field="country_id" class="mt-1" />
                                    </div>

                                    <div class="col-12 col-md-4 mt-2">
                                        <label for="" class="my-0"><small><strong>DEPARTAMENTO /
                                                    PROVINCIA</strong></small></label>
                                        <select name="state_id" id="state" class="form-select" required>
                                            <option value="">SELECCIONE EL DEPARTAMENTO / PROVINCIA</option>
                                        </select>
                                        <x-error field="state_id" class="mt-1" />
                                    </div>

                                    <div class="col-12 col-md-4 mt-2">
                                        <label for="" class="my-0"><small><strong>CIUDAD</strong></small></label>
                                        <select name="city_id" id="city" class="form-select" required>
                                            <option value="">SELECCIONE LA CIUDAD</option>
                                        </select>
                                        <x-error field="city_id" class="mt-1" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 my-3 mt-2">
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

@push('scripts')
    @include('partials.locations')
@endpush
