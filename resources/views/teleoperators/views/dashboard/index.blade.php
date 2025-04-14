@extends('layouts.teleoperators')

@section('content')
<div class="container-fluid">


    @include ('teleoperators.partials.notes')


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

        });

    </script>

@endpush




