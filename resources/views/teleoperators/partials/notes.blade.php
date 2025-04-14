<div class="notes">
    <div class="card">
        <div class="card-body p-4">
            <div class="mb-2">
                <h4 class="card-title fw-semibold">Iniciar nota</h4>
                <p class="card-subtitle">Introduce el número de celular</p>
            </div>

            <form id="noteForm">
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control"  name="cellphone" id="cellphone"  placeholder="Ej: 612345678"  value="" autocomplete="new-password">
                    </div>
                <div class="col-12">
                    <div class="errors mb-3 d-none">
                    </div>
                </div>

                <button type="submit" id="startNote" class="btn btn-primary w-100 uppercase">Iniciar nota</button>
                <div id="noteError" class="text-danger mt-2" style="display: none;"></div>
            </form>
        </div>
    </div>
</div>


@push('scripts')

    <script type="text/javascript">
        jQuery.validator.addMethod(
            'cellphone',
            function (value, element) {
                return this.optional(element) || /^(6|7)[0-9]{8}$/.test(value);
            },
            'Por favor, ingrese un número de teléfono móvil válido de España'
        );

        $(document).ready(function () {
            $('#noteForm').validate({
                rules: {
                    cellphone: {
                        required: true,
                        cellphone: true
                    }
                },
                messages: {
                    cellphone: {
                        required: 'Debes ingresar un número de celular'
                    }
                },
                submitHandler: function (form, event) {
                    event.preventDefault();

                    const phone = $('#cellphone').val().trim();
                    const $error = $('#noteError');

                    $error.hide().text('');

                    $.ajax({
                        url: '{{ route("teleoperator.notes.validate") }}',
                        method: 'GET',
                        data: { cellphone: phone },
                        success: function (response) {
                            const $error = $('.errors');
                            $error.addClass('d-none').text('');

                            if (response.exists && response.blocked) {
                                $error.text(response.message).removeClass('d-none');
                                return;
                            }

                            if (response.exists && response.success === true) {
                                window.location.href = '{{ route("teleoperator.notes.view", ":uid") }}'.replace(':uid', response.uid);
                                return;
                            }

                            if (!response.exists) {
                                window.location.href = '{{ route("teleoperator.notes.generate", ":uid") }}'.replace(':uid', phone);
                                return;
                            }
                        },
                        error: function () {
                            $('.errors').text('Error al validar el número. Inténtalo de nuevo.').removeClass('d-none');
                        }
                    });

                }
            });
        });
    </script>


@endpush


