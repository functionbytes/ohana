@extends('layouts.managers')

@section('content')

            <div class="container-fluid">

                <div class="row justify-content-center navegation-content">
                    <div class="col-lg-12 text-center">
                        <span class="fw-bolder text-uppercase fs-2 d-block mb-1">DELEGACIÓN</span>
                            <h3 class="fw-bolder mb-0 fs-8 lh-base">{{ $delegation->title }}</h3>
                    </div>
                </div>

                <div class="row justify-content-center mt--20">
                    <div class="col-sm-6 col-lg-3">
                        <a class="card" href="{{ route('manager.delegations.locations', $delegation->uid) }}">
                            <div class="card-body text-center">
                                <span class="fw-bolder text-uppercase fs-2 d-block mb-7">Opción</span>
                                <div class="my-4">
                                    <i class="font-navegation fa-sharp-duotone fa-solid fa-house-blank"></i>
                                </div>
                                <h4 class="fw-bolder  text-uppercase mb-3">PUNTOS</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <a class="card" href="{{ route('manager.delegations.employees', $delegation->uid) }}">
                            <div class="card-body text-center">
                                <span class="fw-bolder text-uppercase fs-2 d-block mb-7">Opción</span>
                                <div class="my-4">
                                    <i class="font-navegation fa-duotone fa-user-vneck-hair"></i>
                                </div>
                                <h4 class="fw-bolder  text-uppercase mb-3">Empleados</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <a class="card" href="{{ route('manager.delegations.notes', $delegation->uid) }}">
                            <div class="card-body text-center">
                                <span class="fw-bolder text-uppercase fs-2 d-block mb-7">Opción</span>
                                <div class="my-4">
                                    <i class="font-navegation fa-duotone fa-ballot-check"></i>
                                </div>
                                <h4 class="fw-bolder  text-uppercase mb-3">Notas</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

@endsection

