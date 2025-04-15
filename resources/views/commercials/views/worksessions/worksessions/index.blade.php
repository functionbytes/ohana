@extends('layouts.commercials')'

@section('content')


    <div class="widget-content searchable-container list">

        @include ('commercials.partials.worksessions')


        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table align-middle text-nowrap">
                    <thead class="header-item">
                    <tr>
                        <th>Estado jornada</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($worksessions as $worksession)
                        <tr class="search-items">
                            <td>
                                @if ($worksession->check_in && $worksession->check_out)
                                    <span class="badge bg-success text-white uppercase f-13">Finalizado</span>
                                @elseif ($worksession->check_in)
                                    <span class="badge bg-progress text-dark uppercase f-13">En curso</span>
                                @else
                                    <span class="badge bg-secondary text-white uppercase f-13">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $worksession->check_in_formatted }}</td>
                            <td>{{ $worksession->check_out_formatted }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="result-body">
                <span>Mostrar {{ $worksessions->firstItem() }}-{{ $worksessions->lastItem() }} de {{ $worksessions->total() }} resultados</span>
                <nav>
                    {{ $worksessions->appends(request()->input())->links() }}
                </nav>
            </div>
        </div>

    </div>
@endsection

