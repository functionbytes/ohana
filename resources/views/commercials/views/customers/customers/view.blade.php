@extends('layouts.commercials')

@section('content')

    <div class="container-fluid">

        @include('managers.includes.card', ['title' => "Detalle cliente"])

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
                                <div class="col-6 mb-3">
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
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="card-title fw-semibold">Estado actual del cliente</h4>
                            <p class="card-subtitle text-muted mb-0">Último estado asignado y responsable de la gestión</p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $customer->null  }}" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('scripts')


@endpush



