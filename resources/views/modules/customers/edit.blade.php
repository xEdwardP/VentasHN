@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Editar Cliente</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12 mt-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datos del Cliente</h5>
                            <form action="{{ route('customers.update', $item->document) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-3 mt-1">
                                        <label for="document"><small><strong>Documento</strong></small></label>
                                        <input type="text" class="form-control" id="document" name="document"
                                            value="{{ $item->document }}" minlength="14" maxlength="15" readonly required>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <label for="name"><small><strong>Nombre del Cliente</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name"
                                            value="{{ $item->name }}" maxlength="150" required>
                                    </div>

                                    <div class="col-3 mt-2">
                                        <label for="type"><small><strong>Tipo de Cliente</strong></small></label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="mayorista"
                                                {{ old('type', $item->type ?? '') == 'mayorista' ? 'selected' : '' }}>
                                                Mayorista</option>
                                            <option value="minorista"
                                                {{ old('type', $item->type ?? '') == 'minorista' ? 'selected' : '' }}>
                                                Minorista</option>
                                        </select>
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
                                    </div>

                                    <div class="col-12 col-md-4 mt-2">
                                        <label for="" class="my-0"><small><strong>DEPARTAMENTO /
                                                    PROVINCIA</strong></small></label>
                                        <select name="state_id" id="state" class="form-select" required>
                                            <option value="">SELECCIONE EL DEPARTAMENTO / PROVINCIA</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4 mt-2">
                                        <label for="" class="my-0"><small><strong>CIUDAD</strong></small></label>
                                        <select name="city_id" id="city" class="form-select" required>
                                            <option value="">SELECCIONE LA CIUDAD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-2">
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

@push('scripts')
    @include('partials.locations')
@endpush