@extends('layouts.callcenters')

@section('content')

    @include('distributors.includes.card', ['title' => 'Usuarios ' . $enterprise->title])

    <div class="widget-content searchable-container list">

        <div class="card card-body">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <form class="position-relative form-search" action="{{ request()->fullUrl() }}" method="GET">
                        <div class="row justify-content-between g-2 ">
                            <div class="col-auto flex-grow-1">
                                <div class="tt-search-box">
                                    <div class="input-group">
                                        <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i data-feather="search"></i></span>
                                        <input class="form-control rounded-start w-100" type="text" id="search" name="search" placeholder="Buscar" @isset($searchKey) value="{{ $searchKey }}" @endisset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Buscar">
                                    <i class="fa-duotone fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <div class="col-auto">
                                <a href=" {{ route('callcenter.enterprises.users.create', $enterprise->uid) }}" class="btn btn-primary">
                                    <i class="fa-duotone fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                    <tr>
                        <th>Identificación</th>
                        <th>Cliente</th>
                        <th>Correo electronico</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $key => $user)
                        <tr class="search-items">


                            <td>
                                <span class="usr-email-addr" data-email="{{ $user->identification }}">{{ ucfirst($user->identification) }}</span>
                            </td>
                            <td>
                                <span class="usr-email-addr" data-email="{{ $user->firstname . ' ' . $user->lastname }}">{{ Str::words( Str::upper(Str::lower($user->firstname . ' ' . $user->lastname)), 12, '...')  }}</span>
                            </td>
                            <td>
                                <span class="usr-email-addr" data-email="{{ $user->email }}">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="usr-ph-no" data-phone="{{ date('Y-m-d', strtotime($user->updated_at)) }}">{{ date('Y-m-d', strtotime($user->updated_at)) }}</span>
                            </td>
                            <td class="text-left">
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots fs-5"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                        @if(count($user->certificates)>0)
                                            <li>
                                                <a class="dropdown-item {{ $user->role == 'customer' ? '': 'd-none' }} d-flex align-items-center gap-3" href="{{ route('callcenter.enterprises.users.results', $user->uid) }}">
                                                    Resultados
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item {{ $user->role == 'customer' ? '': 'd-none' }} d-flex align-items-center gap-3" href="{{ route('callcenter.enterprises.users.certificates', $user->uid) }}">
                                                    Certificados
                                                </a>
                                            </li>
                                        @endif
                                        @if(count($user->inscriptions)>0)
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('callcenter.enterprises.users.courses', $user->uid) }}">
                                                    Cursos
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('callcenter.enterprises.users.view', $user->uid) }}">
                                                Visualizar
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3" href="{{ route('callcenter.enterprises.users.edit', $user->uid) }}">
                                                Editar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="result-body ">
                <span>Mostrar {{ $users->firstItem() }}-{{ $users->lastItem() }} de {{ $users->total() }} resultados</span>
                <nav>
                    {{ $users->appends(request()->input())->links() }}
                </nav>
            </div>
        </div>
    </div>
@endsection


