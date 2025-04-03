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
                                    <div class="form-group">
                                        <label for="document">DNI</label>
                                        <input type="text" class="form-control" id="document" name="document" value="{{ $item->document }}" maxlength="13" style="width: 400px" readonly>
                                    </div>

                                    <div class="col-12 mt-1">
                                        <label for="name"><small><strong>Nombre del Cliente</strong></small></label>
                                        <input type="text" class="form-control" required name="name" id="name"
                                            value="{{ $item->name }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipo de Cliente</label>
                                    <select class="form-control" id="type" name="type" style="width: 200px" required>
                                        <option value="mayorista" {{ old('type', $item->type ?? '') == 'mayorista' ? 'selected' : '' }}>Mayorista</option>
                                        <option value="minorista" {{ old('type', $item->type ?? '') == 'minorista' ? 'selected' : '' }}>Minorista</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">País</label>
                                        <select class="form-control form-control-sm" id="country" name="country" style="width: 360px" required>
                                            <option value="Honduras" {{ old('country', $item->country ?? '') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                            <option value="Argentina" {{ old('country', $item->country ?? '') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                            <option value="España" {{ old('country', $item->country ?? '') == 'España' ? 'selected' : '' }}>España</option>
                                            <option value="Colombia" {{ old('country', $item->country ?? '') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                            <option value="Chile" {{ old('country', $item->country ?? '') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                            <option value="Perú" {{ old('country', $item->country ?? '') == 'Perú' ? 'selected' : '' }}>Perú</option>
                                            <option value="Ecuador" {{ old('country', $item->country ?? '') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                            <option value="Venezuela" {{ old('country', $item->country ?? '') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                            <option value="Uruguay" {{ old('country', $item->country ?? '') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                            <option value="Bolivia" {{ old('country', $item->country ?? '') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mt-1">
                                        <label for="city"><small><strong>Ciudad</strong></small></label>
                                        <input type="text" class="form-control form-control-sm" id="city"
                                            value="{{ $item->city}}" name="city" required
                                            maxlength="12" style="width: 360px">
                                    </div>
                                </div>
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
