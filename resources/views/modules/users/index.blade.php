@extends('layouts.main')

@section('title', $title)

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Usuarios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div
                                class="card-header bg-light d-flex justify-content-between align-items-center py-3 border-bottom">
                                <h5 class="card-title mb-0 fw-semibold text-primary">
                                    <i class="bi bi-people-fill me-2"></i>Usuarios Registrados
                                </h5>
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm rounded-pill">
                                    <i class="bi bi-person-add me-2"></i>Nuevo Usuario
                                </a>
                            </div>

                            <div class="table-responsive p-2">
                                <table class="table table-hover align-middle datatable" style="min-width: 800px">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Email</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Nombre</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Rol</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Clave</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Estado</th>
                                            <th class="text-center text-uppercase small text-muted fw-semibold">Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0" id="tbody-users">
                                        @include('modules.users.tbody')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('modules.users.modal_change_password')
@endsection

@push('scripts')
    <script>
        function refresh_tbody() {
            $.ajax({
                type: "GET",
                url: "{{ route('users.tbody') }}",
                success: function(response) {
                }
            });
        }

        function change_state(id, state) {
            $.ajax({
                type: "GET",
                url: "users/change-state/" + id + "/" + state,
                success: function(response) {
                    if (response == 1) {
                        Swal.fire({
                            title: 'Exito!',
                            text: 'Cambio de estado exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                        refresh_tbody();
                    } else {
                        Swal.fire({
                            title: 'Fallo!',
                            text: 'No se llevo a cabo el cambio!',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
        }

        function setIdUser(id) {
            $('#user_id').val(id);
        }

        function changePassword() {
            let id = $('#user_id').val();
            let password = $('#password').val();

            $.ajax({
                type: "GET",
                url: "users/change-password/" + id + "/" + password,
                success: function(response) {
                    if (response == 1) {
                        Swal.fire({
                            title: 'Exito!',
                            text: 'Cambio de password exitoso!',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                        $('#frmPassword')[0].reset();
                    } else {
                        Swal.fire({
                            title: 'Fallo!',
                            text: 'Cambio de password no exitoso!',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });
            return false;
        }

        $(document).ready(function() {
            $('.form-check-input').on("change", function() {
                let id = $(this).attr("id");
                let state = $(this).is(":checked") ? 1 : 0;
                change_state(id, state)
            });
        });
    </script>
@endpush
