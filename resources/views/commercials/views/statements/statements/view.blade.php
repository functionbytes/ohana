@extends('layouts.commercials')'

@section('content')

    <div class="container-fluid">

        @include('managers.includes.card', ['title' => "Detalle nota {$note->number}"])

        <div class="row">
            <div class="col-lg-8 ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-7">
                            <h4 class="card-title">Información cliente</h4>
                            <button class="navbar-toggler border-0 shadow-none d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="ti ti-menu fs-5 d-flex"></i>
                            </button>
                        </div>
                        <div class="row">
                            @if($customer->firstname)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Nombres</label>
                                    <input type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}" placeholder="Ingresar nombres" disabled>
                                </div>
                            @endif

                            @if($customer->lastname)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}" placeholder="Ingresar apellidos" disabled>
                                </div>
                            @endif

                            @if($customer->identification)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Identificación</label>
                                    <input type="text" class="form-control" name="identification" value="{{ $customer->identification }}" placeholder="Ingresar la identificación" disabled>
                                </div>
                            @endif

                            @if($customer->cellphone)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Teléfono</label>
                                    <input type="text" class="form-control" name="cellphone" value="{{ $customer->cellphone }}" placeholder="Ingresar el celular" disabled>
                                </div>
                            @endif

                            @if($customer->email)
                                <div class="col-12 mb-3">
                                    <label class="control-label col-form-label">Correo electrónico</label>
                                    <input type="text" class="form-control" name="email" value="{{ $customer->email }}" placeholder="Ingresar el correo electrónico" disabled>
                                </div>
                            @endif

                            @if($customer->phone)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Teléfono (opcional)</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="Ingresar el celular" disabled>
                                </div>
                            @endif

                            @if($customer->postalcode)
                                <div class="col-6 mb-3">
                                    <label class="control-label col-form-label">Código postal</label>
                                    <input type="text" class="form-control" name="address" value="{{  $customer->postalcode->full_label }}" placeholder="Ingresar la dirección" disabled>
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

                            @if($customer->parish)
                                <div class="col-12 mb-3">
                                    <label class="control-label col-form-label">Parroquia (opcional)</label>
                                    <input type="text" class="form-control" name="parish" value="{{ $customer->parish }}" placeholder="Ingresar la parroquia" disabled>
                                </div>
                            @endif

                            @if($customer->comments)
                                <div class="col-12 mb-3">
                                    <label class="control-label col-form-label">Observaciones</label>
                                    <textarea class="form-control" name="comments" disabled>{{ $customer->comments }}</textarea>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-7">
                            Historial nota
                        </h4>
                        <div cass="table-responsive mb-4 rounded-1">
                            <table class="table mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                <tr>
                                    <th>
                                        <h6 class="fs-3 fw-semibold mb-0">Customer</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-3 fw-semibold mb-0">Nota</h6>
                                    </th>
                                    <th>
                                        <h6 class="fs-3 fw-semibold mb-0 text-end">Date</h6>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($histories as $historie)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../assets/images/profile/user-3.jpg" class="rounded-circle" width="30" height="30">
                                                    <div class="ms-3">
                                                        <h6 class="fs-4 fw-semibold mb-0 text-nowrap">Hanry Lord</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <span class="mb-0 fw-normal fs-3 mt-2">{{ $historie->note }}</span>
                                            </td>
                                            <td>
                                                <p class="mb-0 fw-normal fs-3 text-end text-nowrap">{{ date('Y-m-d', strtotime($historie->note)) }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    <div class="card ">
                        <div class="card-body">
                            <h4 class="card-title fw-semibold">Tasks</h4>
                            <p class="card-subtitle">The Power of Prioritizing Your Tasks</p>
                            <div class="mt-4 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary-subtle text-primary badge">Inprogress</span>
                                    <span class="fs-3 ms-auto">8 March 2020</span>
                                </div>
                                <h6 class="mt-3">NFT Landing Page</h6>
                                <span class="fs-3 lh-sm">Designing an NFT-themed website with a creative concept so th...</span>
                                <div class="hstack gap-3 mt-3">
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-clipboard fs-6 text-primary me-2 d-flex"></i> 2 Tasks
                                    </a>
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-message-dots fs-6 text-primary me-2 d-flex"></i> 13 Commets
                                    </a>
                                </div>
                            </div>
                            <div class="py-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <span class="bg-danger-subtle text-danger badge">Inpending</span>
                                    <span class="fs-3 ms-auto">8 Jan 2024</span>
                                </div>
                                <h6 class="mt-3">Dashboard Finanace Management</h6>
                                <span class="fs-3 lh-sm">Designing an NFT-themed website with a creative concept so th...</span>
                                <div class="hstack gap-3 mt-3">
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-clipboard fs-6 text-primary me-2 d-flex"></i> 4 Tasks
                                    </a>
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-message-dots fs-6 text-primary me-2 d-flex"></i> 50 Commets
                                    </a>
                                </div>
                            </div>
                            <div class="pt-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-success-subtle text-success badge">Completed</span>
                                    <span class="fs-3 ms-auto">8 Feb 2024</span>
                                </div>
                                <h6 class="mt-3">Logo Branding</h6>
                                <span class="fs-3 lh-sm">Designing an NFT-themed website with a creative concept so th...</span>
                                <div class="hstack gap-3 mt-3">
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-clipboard fs-6 text-primary me-2 d-flex"></i> 1 Task
                                    </a>
                                    <a href="javascript:void(0)" class="fs-3 text-bodycolor d-flex align-items-center text-decoration-none">
                                        <i class="ti ti-message-dots fs-6 text-primary me-2 d-flex"></i> 12 Commets
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <h4 class="card-title fw-semibold">Estado actual de la nota</h4>
                                <p class="card-subtitle text-muted mb-0">Último estado asignado y responsable de la gestión</p>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $note->status->title }}" disabled>
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
                                            <a class="text-primary d-block fw-normal">{{ $historie->employee->full_name }}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                    </div>



            </div>
        </div>
    </div>
@endsection



@push('scripts')


@endpush



