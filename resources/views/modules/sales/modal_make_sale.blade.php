<div class="modal fade" id="makeSaleModal" tabindex="-1" aria-labelledby="makeSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="makeSaleModalLabel">
                    <i class="bi bi-receipt me-2"></i>Finalizar Venta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="finalizeSaleForm" action="{{ route('sales.make.sale') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="fw-bold text-center">Total a Pagar: <span
                                    class="text-success">L{{ number_format($total ?? 0, 2) }}</span></h5>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Ubicación -->
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="country" name="country_id" required>
                                    <option value="">Seleccionar país</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="country">País</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="state" name="state_id" required>
                                    <option value="">SELECCIONE EL DEPARTAMENTO / PROVINCIA</option>
                                </select>
                                <label for="state">Departamento</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="city" name="city_id" required>
                                    <option value="">Seleccionar ciudad</option>
                                </select>
                                <label for="city">Ciudad</label>
                            </div>
                        </div>

                        <!-- Cliente -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="customer_document"
                                    name="customer_document" placeholder="RTN del cliente" pattern="[0-9]{14}"
                                    maxlength="14">
                                <label for="customer_document">RTN del Cliente (opcional)</label>
                                <small class="text-muted">Formato: 14 dígitos sin guiones</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Confirmar Venta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            // Carga dinámica de estados
            $('#country').on('change', function() {
                const countryId = $(this).val();
                $('#state').html('<option value="">Cargando...</option>').prop('disabled', true);
                $('#city').html('<option value="">Seleccione primero un estado</option>').prop('disabled',
                    true);

                if (countryId) {
                    $.get(`/get-states/${countryId}`, function(data) {
                        let options = '<option value="">Seleccione</option>';
                        data.forEach(state => {
                            options += `<option value="${state.id}">${state.name}</option>`;
                        });
                        $('#state').html(options).prop('disabled', false);
                    });
                }
            });

            // Carga dinámica de ciudades
            $('#state').on('change', function() {
                const stateId = $(this).val();
                $('#city').html('<option value="">Cargando...</option>').prop('disabled', true);

                if (stateId) {
                    $.get(`/get-cities/${stateId}`, function(data) {
                        let options = '<option value="">Seleccione</option>';
                        data.forEach(city => {
                            options += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#city').html(options).prop('disabled', false);
                    });
                }
            });
        });
    </script>
@endpush --}}

