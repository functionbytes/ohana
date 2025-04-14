@extends('layouts.commercials')'

@section('content')

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">

            <div class="card w-100">

                <form id="formStatements" enctype="multipart/form-data" role="form" onSubmit="return false">

                    {{ csrf_field() }}


                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">

                            <h5 class="mb-0 uppercase">Crear venta
                            </h5>

                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para que puedas actualizar y modificar la información de manera eficiente y segura. A continuación, encontrarás diversos <mark><code>campos</code></mark> que corresponden a los datos previamente suministrados. Te invitamos a revisar y ajustar cualquier información que consideres necesario actualizar para mantener tus datos al día.
                        </p>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Nombres</label>
                                <input type="text" class="form-control"  name="firstname" value="{{$customer->firstname}}" placeholder="Ingresar nombres"  autocomplete="new-password" disabled>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Apellidos</label>
                                <input type="text" class="form-control" name="lastname" value=""{{$customer->lastname}}" placeholder="Ingresar apellidos" autocomplete="new-password">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">DNI/NIE/CIF</label>
                                <input type="text" class="form-control" name="identification" value="{{$customer->identification}}" placeholder="Ingresar la identificacion" autocomplete="new-password">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="control-label col-form-label">Fecha de nacimiento</label>
                                <input type="text" class="form-control picker" name="birth" value="{{$customer->birth_at }}" autocomplete="off">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Iban</label>
                                <input type="text" class="form-control" name="iban" value="{{$customer->iban}}" placeholder="Ingresar el iban" autocomplete="new-password">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Correo electronico</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="Ingresar el correo electronico" autocomplete="new-password">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Vivienda</label>
                                <select class="form-control select2" id="housing" name="housing">
                                    @foreach($housings as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="housing-error" class="error" for="housing" style="display: none"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Estado civil</label>
                                <select class="form-control select2" id="marital" name="marital">
                                    @foreach($maritals as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="marital-error" class="error" for="marital" style="display: none"></label>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Ingresos netros</label>
                                <select class="form-control select2" id="payment" name="payment">
                                    @foreach($payments as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="payment-error" class="error" for="payment" style="display: none"></label>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Situación laboral</label>
                                <select class="form-control select2" id="relationship" name="relationship">
                                    @foreach($relationships as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="status-error" class="error" for="status" style="display: none"></label>
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Telefono</label>
                                <input type="text" class="form-control"  name="cellphone" value="{{$cellphone}}" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label  class="control-label col-form-label">Telefono (opcional)</label>
                                <input type="text" class="form-control"  name="phone" value="" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label class="control-label col-form-label">Fecha de entrega</label>
                                <input type="text" class="form-control picker" name="delivery" value="{{$customer->delivery_at }}" autocomplete="off">
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Horario de entrega</label>
                                <select class="form-control select2" id="schedule" name="schedule">
                                    @foreach($schedules as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="schedule-error" class="error" for="schedule" style="display: none"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">¿Has entregado una crema al cliente?</label>
                                <select class="form-control select2" id="cream" name="cream">
                                    @foreach($creams as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="cream-error" class="error" for="cream" style="display: none"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">¿Has entregado un accesorio al cliente?</label>
                                <select class="form-control select2" id="cream" name="accessorie">
                                    @foreach($accessories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="accessorie-error" class="error" for="accessorie" style="display: none"></label>
                            </div>

                            <hr class="mb-4 mt-3">

                            <div class="d-flex flex-column mb-3">
                                <h5 class="mb-0 text-uppercase fw-semibold">Gestión Comercial</h5>
                                <p class="card-subtitle text-muted mt-2">
                                    En esta sección encontrarás toda la información relacionada con la actividad comercial, incluyendo el estado de contacto con el cliente, reprogramaciones de llamadas, seguimiento y otras acciones realizadas por el equipo comercial.
                                </p>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Oferta</label>
                                <select class="form-control select2" id="bundle" name="bundle">
                                    @foreach($bundles as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="bundle-error" class="error" for="bundle" style="display: none"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="status" class="control-label col-form-label">Número de cuotas</label>
                                <select class="form-control select2" id="installment" name="installment">
                                    <option disabled></option>
                                    @for ($i = 1; $i <= 39; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <label id="employment-error" class="error" for="employment" style="display: none"></label>
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Observaciones adicionales para esta venta</label>
                                <textarea type="text" class="form-control"  name="notes"  autocomplete="new-password"></textarea>
                            </div>

                            <div class="list-bundles-container"></div>

                            <div id="global-installment-summary" class="mt-3"></div>

                            <div class="col-12">
                                <div class="errors mb-3 d-none">
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="border-top pt-1 mt-2">
                                    <button type="submit" class="btn btn-info  px-4 waves-effect waves-light mt-2 w-100">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div id="confirmSaleModal" class="modal fade modal-bundle">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Selecciona los artículos de la oferta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" id="modal-offer-content">
                    <div class="text-center text-muted">Cargando...</div>
                </div>
            </div>
        </div>
    </div>


@endsection



@push('scripts')

    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        $(document).ready(function() {

            if ($.fn.select2 && $('#bundle').hasClass("select2-hidden-accessible")) {
                $('#bundle').select2('destroy');
            }

            $('#bundle').select2({
                width: '100%'
            });

            $('#bundle').on('change', function () {
                const bundleId = $(this).val();
                const modal = $('#confirmSaleModal');
                const modalContent = $('#modal-offer-content');

                if (!bundleId) return;

                modalContent.html('<div class="text-center text-muted">Cargando...</div>');
                modal.modal('show');

                $.get("{{ route('commercial.statements.bundle.content', ':id') }}".replace(':id', bundleId), function (data) {
                    modalContent.html(data);

                    $('#confirmSaleModal .select2').select2({
                        dropdownParent: $('#confirmSaleModal'),
                        width: '100%'
                    });
                }).fail(function () {
                    modalContent.html('<div class="text-danger text-center">Error al cargar los productos de la oferta.</div>');
                });
            });

            $(document).on('click', '#confirm-bundle', function () {
                const bundleTitle = $('#bundle option:selected').text();
                const bundleId = $('#bundle').val();

                if (!bundleId) return;

                const selected = [];
                let itemsHtml = '';

                const bundleSelect = $(`.select2[data-bundle-id="${bundleId}"]`).first();
                const bundleAmount = parseFloat(bundleSelect.data('bundle-amount')) || 0;
                const installment = parseInt($('#bundle').data('installment')) || 1;
                const installmentAmount = (bundleAmount / installment).toFixed(2);

                $('.select2').each(function () {
                    const categoryId = $(this).data('category-id');
                    const bundleSelectId = $(this).data('bundle-id');
                    if (bundleSelectId != bundleId) return;

                    const selectedOption = $(this).find('option:selected');
                    const productId = selectedOption.val();
                    const productTitle = selectedOption.text();

                    if (productId) {
                        selected.push({ bundleId, categoryId, productId, productTitle });

                        itemsHtml += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${productTitle}
                    <span class="badge bg-success">1 ud</span>
                </li>`;
                    }
                });

                if (selected.length > 0) {
                    $(`.bundle-block[data-bundle="${bundleId}"]`).remove();

                    const block = `
            <div class="bundle-block mb-3" data-bundle="${bundleId}">
                <div class="d-flex justify-content-between align-items-center bundle-head">
                    <strong>Oferta: ${bundleTitle}</strong>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-clear-bundle" data-bundle="${bundleId}">
                        <i class="fas fa-trash-alt me-1"></i>
                    </button>
                </div>
                <ul class="list-group list-group-flush">
                    ${itemsHtml}
                </ul>
                <input type="hidden" name="bundles[${bundleId}][amount]" value="${bundleAmount.toFixed(2)}">
                <input type="hidden" name="bundles[${bundleId}][installment]" value="${installment}">
                <input type="hidden" name="bundles[${bundleId}][installment_amount]" value="${installmentAmount}">
            </div>`;

                    $('.list-bundles-container').append(block);
                    $('#confirmSaleModal').modal('hide');
                    updateGlobalInstallmentSummary();
                }
            });

            $(document).on('click', '.btn-clear-bundle', function () {
                const bundleId = $(this).data('bundle');
                $(`.bundle-block[data-bundle="${bundleId}"]`).remove();
                $(`.select2[data-bundle-id="${bundleId}"]`).val('').trigger('change');
                updateGlobalInstallmentSummary();
            });

            $(document).on('change', '#installment', function () {
                updateGlobalInstallmentSummary();
            });

            function updateGlobalInstallmentSummary() {
                let totalAmount = 0;
                let totalItems = 0;
                const installment = parseInt($('#installment').val()) || 1;

                $('.bundle-block').each(function () {
                    const bundleId = $(this).data('bundle');
                    const amount = parseFloat($(this).find(`input[name="bundles[${bundleId}][amount]"]`).val()) || 0;
                    const itemsCount = $(this).find('.list-group-item').length;

                    totalAmount += amount;
                    totalItems += itemsCount;
                });

                if (totalAmount === 0) {
                    $('#global-installment-summary').empty();
                    return;
                }

                const installmentAmount = (totalAmount / installment).toFixed(2);

                const html = `
        <div class="container-installment p-2 small alert alert-info">
            Importe total: <strong>${totalAmount.toFixed(2)}€</strong>,
            Puntos: <strong>${totalItems}</strong>,
            Cuotas: <strong>${installment}</strong>,
            Cuota mensual: <strong>${installmentAmount}€</strong>
        </div>`;

                $('#global-installment-summary').html(html);
            }


            $('#status').select2({
                placeholder: 'Seleccionar un estado',
            });

            $('.picker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: new Date(),
                todayHighlight: true
            });

            $('.postalcode').select2({
                theme: 'bootstrap-5',
                placeholder: 'Buscar código postal...',
                ajax: {
                    url: '{{ route("teleoperator.postalcodes.search") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.text
                                };
                            })
                        };
                    },
                    cache: true
                }
            });


            function toggleVisitFields() {
                const status = $('#status').val();

                // Estado 1 → Mostrar visita
                if (status == '1') {
                    $('.container-schedule').removeClass('d-none');
                    $('.container-visit').removeClass('d-none');
                } else {
                    $('.container-schedule')
                        .addClass('d-none')
                        .find('input, textarea').val('');
                    $('.container-schedule').find('select').val(null).trigger('change'); // Select2

                    $('.container-visit')
                        .addClass('d-none')
                        .find('input, textarea').val('');
                    $('.container-visit').find('select').val(null).trigger('change');
                }

                // Estado 2 → Mostrar próxima llamada
                if (status == '2') {
                    $('.container-nextcall').removeClass('d-none');
                } else {
                    $('.container-nextcall')
                        .addClass('d-none')
                        .find('input, textarea').val('');
                    $('.container-nextcall').find('select').val(null).trigger('change');
                }
            }


            toggleVisitFields();

            $('#status').on('change', function () {
                toggleVisitFields();
            });

            $(".picker").datepicker({
    onSelect: function(dateText, inst) {
        $(this).datepicker("hide");
    }
});

            jQuery.validator.addMethod(
                'cellphone',
                function (value, element) {
                    return this.optional(element) || /^(6|7)[0-9]{8}$/.test(value);
                },
                'Por favor, ingrese un número de teléfono móvil válido de España'
            );

            jQuery.validator.addMethod(
                'emailExt',
                function (value, element) {
                    if (value === '') return true;
                    return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\\.,;:\s@\"]+\.)+[^<>()[\]\\.,;:\s@\"]{2,})$/i.test(value);
                },
                'Por favor, ingrese un correo electrónico válido.'
            );

            $("#formStatements").validate({
                submit: false,
                ignore: ".ignore",
                rules: {
                    firstname: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status === '1';
                        },
                        minlength: 3,
                        maxlength: 100,
                    },
                    lastname: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status === '1';
                        },
                        minlength: 3,
                        maxlength: 100,
                    },
                    identification: {
                        required: false,
                        minlength: 1,
                        maxlength: 9,
                    },
                    email: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status === '1';
                        },
                        emailExt: true,
                    },
                    cellphone: {
                        required: true,
                        cellphone: true,
                    },
                    phone: {
                        required: false,
                        cellphone: true,
                    },
                    address: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status === '1';
                        },
                        minlength: 1,
                        maxlength: 1000,
                    },
                    secondaddress: {
                        required: false,
                        minlength: 1,
                        maxlength: 1000,
                    },
                    parish: {
                        required: false,
                        minlength: 1,
                        maxlength: 1000,
                    },
                    comments: {
                        required: false,
                        minlength: 1,
                        maxlength: 1000,
                    },
                    postalcode: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status === '1';
                        }
                    },
                    status: {
                        required: true,
                    },
                    schedule: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status && status == '1';
                        },
                    },
                    visit: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status && status == '1';
                        },
                    },
                    nextcall: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status && status == '2';
                        },
                    },
                    notes: {
                        required: function (element) {
                            const status = $('#status').val();
                            return status && status == '2';
                        },
                        minlength: 1
                    }
                },
                messages: {
                    firstname: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    lastname: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    identification: {
                        minlength: "Debe contener al menos 1 caracter",
                        maxlength: "Debe contener al menos 9  caracter",
                    },
                    cellphone: {
                        required: "El parametro es necesario.",
                        email: 'Por favor, ingrese un número de teléfono móvil válido de España.',
                    },
                    phone: {
                        required: "El parametro es necesario.",
                        email: 'Por favor, ingrese un número de teléfono móvil válido de España.',
                    },
                    address: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    secondaddress: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    parish: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    comments: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 3 caracter",
                        maxlength: "Debe contener al menos 100 caracter",
                    },
                    postalcode: {
                        required: "El parametro es necesario.",
                    },
                    status: {
                        required: "El parametro es necesario.",
                    },
                    schedule: {
                        required: "El parametro es necesario.",
                    },
                    visit: {
                        required: "El parametro es necesario.",
                    },
                        nextcall: {
                            required: "La fecha de la próxima llamada es obligatoria si el estado es 'Reprogramar'."
                        },
                        notes: {
                            required: "El campo de observaciones es obligatorio.",
                            minlength: "Las observaciones deben tener al menos 5 caracteres."
                        },

                },
                submitHandler: function(form) {

                    var $form = $('#formStatements');
                    var formData = new FormData($form[0]);

                    var $submitButton = $('button[type="submit"]');
                    $submitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('teleoperator.notes.store') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {

                            if(response.success == true){

                                message = response.message;

                                toastr.success(message, "Operación exitosa", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right"
                                });

                                setTimeout(function() {
                                    window.location.href = "{{ route('teleoperator.notes') }}";
                                }, 2000);

                            }else{

                                $submitButton.prop('disabled', false);
                                error = response.message;

                                toastr.warning(error, "Operación fallida", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right"
                                });

                                $('.errors').text(error);
                                $('.errors').removeClass('d-none');

                            }

                        }
                    });

                }

            });



        });

    </script>

@endpush



