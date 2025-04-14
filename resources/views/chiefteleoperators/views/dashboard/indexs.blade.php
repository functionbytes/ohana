@extends('layouts.shops')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body p-4">
            <div class="mb-4">
                <h4 class="card-title fw-semibold">Iniciar nota</h4>
                <p class="card-subtitle">Introduce el número de celular</p>
            </div>
            <div class="input-group mb-3">
                <input id="phoneInput" type="text" class="form-control border-end-0" placeholder="Ej: 612345678">
            </div>
            <button id="startNoteBtn" class="btn btn-primary w-100">Iniciar nota</button>
            <div id="noteError" class="text-danger mt-2" style="display: none;"></div>
        </div>
    </div>


    <div class="row">

        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $totaltickets }}</h4>
                    <p class="mb-2 fs-3">Tickets totales</p>
                    <div id="expense"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $totalactivetickets }}</h4>
                    <p class="mb-1 fs-3">Tickets activos</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $totalclosedtickets }}</h4>
                    <p class="mb-1 fs-3">Tickets cerrados</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $suspendticketcount }}</h4>
                    <p class="mb-1 fs-3">Tickets suspendidos</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $selfassigncount }}</h4>
                    <p class="mb-1 fs-3">Tickets asignados</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $recentticketcount }}</h4>
                    <p class="mb-1 fs-3">Tickets recientes</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $myassignedticketcount }}</h4>
                    <p class="mb-1 fs-3">Mis asignados</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">{{ $myclosedticketcount }}</h4>
                    <p class="mb-1 fs-3">Mis cerrados</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection




@push('scripts')

    <script type="text/javascript">


        $(document).ready(function() {

            $('#startNoteBtn').on('click', function () {
                const phone = $('#phoneInput').val().trim();
                const $error = $('#noteError');

                $error.hide().text('');

                if (!phone) {
                    $error.text('Debes ingresar un número de celular').show();
                    return;
                }

                $.ajax({
                    url: '{{ route("teleoperator.notes.validate") }}',
                    method: 'GET',
                    data: { cellphone: phone },
                    success: function (response) {
                        if (response.exists) {
                            window.location.href = '{{ route("teleoperator.notes.view", ":uid") }}'.replace(':uid', response.uid);
                        } else {
                            window.location.href = '{{ route("teleoperator.notes.generate", ":uid") }}'.replace(':uid', phone);
                        }
                    },
                    error: function () {
                        $error.text('Error al validar el número. Inténtalo de nuevo.').show();
                    }
                });
            });


    </script>

@endpush




