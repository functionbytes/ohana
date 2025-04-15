
<div class=" worksessions">
    <div class="card w-100 ">
        <div class="card-body">
            <h4 class="card-title fw-semibold">Fichaje de jornada</h4>
            <p class="card-subtitle mb-3">Entrada / Salida</p>

            <div class="text-center mb-3">
                <div id="clock" class="h1 fw-bold mb-2"></div>
                <div id="status" class="text-muted"></div>
            </div>

            <div class="d-flex justify-content-center">
                <button id="worksession" class="btn btn-primary w-100">
                    Fichar entrada
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script type="text/javascript">


        $(document).ready(function() {

            const $btn = $('#worksession');
            const $status = $('#status');
            let status = 'no_session';

            function updateClock() {
                const now = new Date();
                document.getElementById('clock').textContent = now.toLocaleTimeString();
            }

            setInterval(updateClock, 1000);
            updateClock();


            $.get("{{ route('commercial.worksessions.status') }}", function (response) {
                status = response.status;

                const $btn = $('#worksession');

                if (status === 'in_progress') {
                    $btn.removeClass('btn-primary').addClass('btn-danger').text('Fichar salida');
                    $status.text('Entrada fichada, pendiente de salida');
                } else if (status === 'completed') {
                    $btn.prop('disabled', true).text('Jornada completada');
                    $status.text('Entrada y salida registradas');
                } else {
                    $btn.removeClass('btn-danger').addClass('btn-primary').text('Fichar entrada');
                    $status.text('Aún no has fichado');
                }
            });

            $('#worksession').on('click', function () {
                const $btn = $(this);
                const route = (status === 'in_progress')
                    ? "{{ route('commercial.worksessions.checkout') }}"
                    : "{{ route('commercial.worksessions.checkin') }}";

                $.post(route, {_token: '{{ csrf_token() }}'}, function (response) {
                    $('#status').text(response.message);
                    if (response.success) {
                        if (status === 'in_progress') {
                            $btn.prop('disabled', true).text('Jornada completada');
                            status = 'completed';
                        } else {
                            $btn.removeClass('btn-primary').addClass('btn-danger').text('Fichar salida');
                            status = 'in_progress';
                        }
                    }
                });
            });

        });

    </script>

@endpush



