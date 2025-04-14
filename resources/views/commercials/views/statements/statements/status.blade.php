@extends('layouts.commercials')

@section('content')
    <div class="container-notes-status">
        <div class="row justify-content-center navegation-content">
            <div class="col-lg-12 text-center">
                <span class="fw-bolder text-uppercase fs-2 d-block mb-1">SEGUIMIENTO GPS</span>
                <h3 class="fw-bolder mb-0 fs-8 lh-base">Opciones de acción GPS para la nota</h3>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-1">
            {{-- Botón manual para LLEVAME --}}
            @if($note->gps == 1 && $note->gps_latitude && $note->gps_longitude)
                @php
                    $lat = $note->gps_latitude;
                    $lng = $note->gps_longitude;
                    $mapsWeb = "https://www.google.com/maps/dir/?api=1&destination={$lat},{$lng}";
                    $mapsApp = "comgooglemaps://?daddr={$lat},{$lng}&directionsmode=driving";
                @endphp

                <a href="#"
                   class="card item-status btn-llevame"
                   style="width: 32%;"
                   data-web="{{ $mapsWeb }}"
                   data-app="{{ $mapsApp }}">
                    <div class="card-body text-center">
                        <div class="my-4">
                            <i class="fa-solid fa-route font-navegation fs-3x"></i>
                        </div>
                        <h4 class="fw-bolder text-uppercase mb-3">LLEVAME</h4>
                    </div>
                </a>
            @endif


        @foreach($types as $type)
                @php
                    $icon = match($type->slug) {
                        'gps' => 'fa-solid fa-location-crosshairs',
                        'de-camino' => 'fa-solid fa-truck-fast',
                        'dentro' => 'fa-solid fa-house-person-return',
                        default => 'fa-solid fa-location-dot',
                    };
                @endphp

                {{-- Ocultar GPS si ya hay ubicación --}}
                @if($type->slug === 'gps' && $note->gps == 1)
                    @continue
                @endif

                <a data-slug="{{ $type->slug }}"
                   data-title="{{ $type->name }}"
                   data-uid="{{ $note->uid }}"
                   data-statement="{{ $statement->uid }}"
                   href="#"
                   class="card item-status btn-annotation"
                   style="width: 32%;">
                    <div class="card-body text-center">
                        <div class="my-4">
                            <i class="{{ $icon }} font-navegation fs-3x"></i>
                        </div>
                        <h4 class="fw-bolder text-uppercase mb-3">{{ $type->title }}</h4>
                    </div>
                </a>
            @endforeach


        </div>



    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-annotation').on('click', function () {
                const slug = $(this).data('slug');
                const uid = $(this).data('uid');
                const statement = $(this).data('statement');

                if (slug === 'llevame') {
                    // Abrir Google Maps con las coordenadas de la nota
                    const lat = "{{ $note->gps_latitude }}";
                    const lon = "{{ $note->gps_longitude }}";

                    if (lat && lon) {
                        const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lon}`;
                        window.open(mapsUrl, '_blank');
                    }

                    return;
                }

                if (slug === 'gps') {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            sendAnnotation(uid, slug, statement, position.coords.latitude, position.coords.longitude);
                        }, function (error) {
                        });
                    }

                    return;
                }

                sendAnnotation(uid, slug, statement);
            });

            function sendAnnotation(uid, slug, statement, latitude = null, longitude = null) {
                $.ajax({
                    url: "{{ route('commercial.statements.annotation.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        statement: statement,
                        slug: slug,
                        uid: uid,
                        latitude: latitude,
                        longitude: longitude
                    },
                    success: function (response) {
                        if (slug === 'dentro') {
                            window.location.href = "{{ route('commercial.statements.arrange', $statement->uid) }}";
                        }else{
                            toastr.success(response.message, "Operación exitosa", {
                                closeButton: true,
                                progressBar: true,
                                positionClass: "toast-bottom-right"
                            });

                        }
                    },
                    error: function () {
                    }
                });
            }
        });


    </script>
@endpush
