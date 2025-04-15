@extends('layouts.commercials')'

@section('content')


    <div class="statements-status">
        <div class="row gap-1 justify-content-center">
            @foreach($status as $statu)
                @php
                    $icon = match($statu->slug) {
                        'nulo' => 'fa-solid fa-ban',
                        'oficina' => 'fa-solid fa-house-laptop',
                        'confirmada' => 'fa-solid fa-heart-circle-exclamation',
                        default => 'fa-solid fa-location-dot',
                    };
                @endphp

                <a data-slug="{{ $statu->slug }}"
                   data-title="{{ $statu->name }}"
                   data-uid="{{ $statement->uid }}"
                   data-statement="{{ $statement->uid }}"
                   href="#"
                   class="card col-sm-12 col-md-3 item-status btn-annotation">
                    <div class="card-body text-center">
                        <div class="my-4">
                            <i class="{{ $icon }} font-navegation fs-3x"></i>
                        </div>
                        <h4 class="fw-bolder text-uppercase mb-3">{{ $statu->title }}</h4>
                    </div>
                </a>
            @endforeach

            <a class="card col-sm-12 col-md-3 item-status btn-sale">
                <div class="card-body text-center">
                    <div class="my-4">
                        <i class="fa-solid fa-wallet font-navegation fs-3x"></i>
                    </div>
                    <h4 class="fw-bolder text-uppercase mb-3">Venta</h4>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 ">

            <div class="card">
                <div class="card-body">
                    <div class=" border-bottom mb-3 pb-3">
                        <h4 class="card-title fw-semibold">Datos de la nota</h4>
                        <p class="card-subtitle">Informacion sobre la nota registrada por el teleoperador</p>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-lg-6 mb-3">
                            <label class="control-label col-form-label">Nota</label>
                            <input type="text" class="form-control" name="number" value="{{ $note->number  }}" placeholder="Ingresar nombres" disabled>
                        </div>

                        <div class="col-sm-12 col-lg-6 mb-3">
                            <label class="control-label col-form-label">Teleoperador</label>
                            <input type="text" class="form-control" name="number" value="{{ $note->teleoperator->id  }}" placeholder="Ingresar nombres" disabled>
                        </div>

                        @if($note->visit_at)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Fecha de visita</label>
                                <input type="text" class="form-control" name="firstname" value="{{ $note->visit_at_formatted  }}" placeholder="Ingresar nombres" disabled>
                            </div>
                        @endif
                        @if($note->schedule)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Horario</label>
                                <input type="text" class="form-control" name="firstname" value="{{ $note->schedule->title }}" placeholder="Ingresar nombres" disabled>
                            </div>
                        @endif
                    </div>

                    <hr>

                    <div class=" pb-3">
                        <h4 class="card-title fw-semibold">Datos del cliente</h4>
                        <p class="card-subtitle">Informacion sobre el cliente</p>
                    </div>

                    <div class="row">
                        @if($customer->firstname)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Nombres</label>
                                <input type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}" placeholder="Ingresar nombres" disabled>
                            </div>
                        @endif

                        @if($customer->lastname)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Apellidos</label>
                                <input type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}" placeholder="Ingresar apellidos" disabled>
                            </div>
                        @endif

                        @if($customer->cellphone)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Teléfono</label>
                                <input type="text" class="form-control" name="cellphone" value="{{ $customer->cellphone }}" placeholder="Ingresar el celular" disabled>
                            </div>
                        @endif


                        @if($customer->phone)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Teléfono</label>
                                <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="Ingresar el celular" disabled>
                            </div>
                        @endif

                        @if($customer->postalcode)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Código postal</label>
                                <input type="text" class="form-control" name="address" value="{{  $customer->postalcode->full_label }}" placeholder="Ingresar la dirección" disabled>
                            </div>
                        @endif

                        @if($customer->parish)
                            <div class="col-sm-12 col-lg-6 mb-3">
                                <label class="control-label col-form-label">Parroquia</label>
                                <input type="text" class="form-control" name="parish" value="{{ $customer->parish }}" placeholder="Ingresar la parroquia" disabled>
                            </div>
                        @endif

                        @if($customer->address)
                            <div class="col-12 mb-3">
                                <label class="control-label col-form-label">Dirección principal</label>
                                <input type="text" class="form-control" name="address" value="{{ $customer->address }}" placeholder="Ingresar la dirección" disabled>
                            </div>
                        @endif

                        @if($customer->secondaddress)
                            <div class="col-12 mb-3">
                                <label class="control-label col-form-label">Dirección secundaria</label>
                                <input type="text" class="form-control" name="secondaddress" value="{{ $customer->secondaddress }}" placeholder="Ingresar la dirección secundaria" disabled>
                            </div>
                        @endif

                        @if($customer->comments)
                            <div class="col-12 mb-6">
                                <label class="control-label col-form-label">Observaciones</label>
                                <textarea class="form-control" name="comments" disabled>{{ $customer->comments }}</textarea>
                            </div>
                        @endif

                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body component--annotations">
                    <h4 class="card-title fw-semibold">Anotaciones de visita</h4>
                    <p class="card-subtitle">Registro de eventos realizados por el comercial</p>

                    <div class="list-annotations">
                        @foreach($annotations as $annotation)
                            <div class="item-annotations">
                                <div class="d-flex justify-content-between align-items-center mb-6">
                                    <div class="body-annotations">
                                        <h6 class="mb-1 fs-4 fw-semibold">{{ strtoupper($annotation->issue) }}</h6>
                                        <p class="fs-3 mb-0">{{ strtoupper($annotation->observations) }}</p>
                                    </div>
                                    <div>
                                        <span class="badge bg-primary-subtle">{{ $annotation->created_at_formatted }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
        <div class="col-lg-4">

            <div class="card card-teleoperator">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3 pe-1">
                            <img src="/managers/images/profile/profile.jpg" class="rounded-circle" alt="modernize-img" width="72" height="72">
                        </div>
                        <div>
                            <h5 class="fw-semibold fs-5 mb-2">
                                {{$note->teleoperator->fullteleoperator}}
                            </h5>
                            <p class=" role">TELEOPERADOR</p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title fw-semibold">Estado actual de la visita</h4>
                        <p class="card-subtitle text-muted mb-0">Último estado asignado y responsable de la gestión</p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{ $statement->status->title }}" disabled>
                    </div>
                </div>
            </div>

            <div class="card w-100">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title fw-semibold">Historial de estados</h4>
                        <p class="card-subtitle text-muted">Consulta los cambios de estado y quién los gestionó</p>
                    </div>
                    <div class="mb-4">
                        <ul class="timeline-widget">
                            @foreach($histories as $historie)
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">
                                        {{ date('Y-m-d', strtotime($historie->note)) }}
                                    </div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">
                                        {{ $historie->status->title }}
                                        <a class="d-block fw-normal">{{ $historie->employee->full_name }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>



        </div>
    </div>


    <div id="confirmSaleModal" class="modal fade ">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="display-4 text-danger"><i data-feather="x-octagon"></i></div>
                    <h4 class="my-0">¿Estás seguro de que quieres generar esta venta?</h4>
                    <p>Todos los datos relacionados con esto pueden eliminarse</p>
                    <div class="row justify-content-center mt-20  ">
                        <div class="col-sm-12 col-md-5">
                            <a href="{{ route('commercial.statements.generate', $statement->uid) }}"  id="delete-link" class="btn btn-danger w-100">Confirmar</a>
                        </div>
                        <div class="col-sm-12 col-md-5">
                            <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            $('.btn-sale').on('click', function (e) {
                e.preventDefault();
                $('#confirmSaleModal').modal('show');
            });

            $('.btn-annotation').on('click', function () {
                const slug = $(this).data('slug');
                const uid = $(this).data('uid');
                const statement = $(this).data('statement');
                sendAnnotation(uid, slug, statement);
            });

            function sendAnnotation(uid, slug, statement) {
                $.ajax({
                    url: "{{ route('commercial.statements.statuses.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        statement: statement,
                        slug: slug,
                        uid: uid
                    },
                    success: function (response) {
                        if (slug === 'dentro') {
                            window.location.href = "{{ route('commercial.statements.arrange', $statement->uid) }}";
                        } else {
                            toastr.success(response.message, "Operación exitosa", {
                                closeButton: true,
                                progressBar: true,
                                positionClass: "toast-bottom-right"
                            });
                        }
                    },
                    error: function () {
                        toastr.error("Ocurrió un error al guardar la anotación.");
                    }
                });
            }
        });
    </script>
@endpush
