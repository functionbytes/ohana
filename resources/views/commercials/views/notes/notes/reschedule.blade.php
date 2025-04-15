@extends('layouts.commercials')'

@section('content')

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">

            <div class="card w-100">

                <form id="formNotes" enctype="multipart/form-data" role="form" onSubmit="return false">

                    <input type="hidden" name="uid" value="{{$note->uid}}" >
                    {{ csrf_field() }}

                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">

                            <h5 class="mb-0 uppercase">Gestionar nota # {{$note->number}}
                            </h5>

                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para que puedas actualizar y modificar la información de manera eficiente y segura. A continuación, encontrarás diversos <mark><code>campos</code></mark> que corresponden a los datos previamente suministrados. Te invitamos a revisar y ajustar cualquier información que consideres necesario actualizar para mantener tus datos al día.
                        </p>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Nombres</label>
                                <input type="text" class="form-control"  name="firstname" value="{{$customer->firstname}}" placeholder="Ingresar nombres"   autocomplete="new-password">
                            </div>
                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Apellidos</label>
                                <input type="text" class="form-control" name="lastname" value="{{$customer->lastname}}" placeholder="Ingresar apellidos" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Identificacion</label>
                                <input type="text" class="form-control" name="identification" value="{{$customer->identification}}" placeholder="Ingresar la identificacion" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Telefono</label>
                                <input type="text" class="form-control"  name="cellphone" value="{{$customer->cellphone}}" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Correo electronico</label>
                                <input type="text" class="form-control" name="email" value="{{$customer->email}}" placeholder="Ingresar el correo electronico" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Telefono (opcional)</label>
                                <input type="text" class="form-control"  name="phone" value="{{$customer->phone}}" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label class="control-label col-form-label">Código postal</label>
                                <select class="form-control postalcode select2" id="postalcode" name="postalcode"></select>
                                <label id="postalcode-error" class="error" for="postalcode" style="display: none"></label>
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Direccion principal</label>
                                <input type="text" class="form-control"  name="address" value="{{$customer->address}}" placeholder="Ingresar la direccion" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Direccion secundaria</label>
                                <input type="text" class="form-control"  name="secondaddress" value="{{$customer->secondaddress}}" placeholder="Ingresar la direccion" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Parroquia  (opcional)</label>
                                <input type="text" class="form-control"  name="parish" value="{{$customer->parish}}" placeholder="Ingresar la parroquia" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Observaciones</label>
                                <textarea type="text" class="form-control"  name="comments"  autocomplete="new-password">{{$customer->comments}}</textarea>
                            </div>

                            <hr class="mb-4 mt-3">

                            <div class="d-flex flex-column mb-3">
                                <h5 class="mb-0 text-uppercase fw-semibold">Gestión Comercial</h5>
                                <p class="card-subtitle text-muted mt-2">
                                    En esta sección encontrarás toda la información relacionada con la actividad comercial, incluyendo el estado de contacto con el cliente, reprogramaciones de llamadas, seguimiento y otras acciones realizadas por el equipo comercial.
                                </p>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="status" class="control-label col-form-label">Estado</label>
                                <select class="form-control select2" id="status" name="status">
                                    @foreach($status as $id => $name)
                                        <option value="{{ $id }}" {{  $note->status_id == $id ? 'selected' : '' }} >{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="status-error" class="error" for="status" style="display: none"></label>
                            </div>

                            <div class="col-6 mb-3 d-none container-schedule">
                                <label for="prioritie" class="control-label col-form-label">Horario visita</label>
                                <select class="form-control select2" id="schedule" name="schedule">
                                    @foreach($schedules as $id => $name)
                                        <option value="{{ $id }}" >{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="schedule-error" class="error" for="schedule" style="display: none"></label>
                            </div>


                            <div class="col-12 mb-3 d-none container-visit">
                                <label  class="control-label col-form-label">Fecha visita</label>
                                <input type="text" class="form-control picker"  name="visit" value=""  autocomplete="new-password">
                            </div>


                            <div class="col-6 mb-3 d-none container-nextcall">
                                <label  class="control-label col-form-label">Reprogramar llamada</label>
                                <input type="text" class="form-control picker"  name="nextcall" value=""  autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3 container-nextcall">
                                <label  class="control-label col-form-label">Reprogramar observaciones</label>
                                <textarea type="text" class="form-control"  name="notes"  autocomplete="new-password"></textarea>
                            </div>

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

@endsection



@push('scripts')

    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        $(document).ready(function() {

            $('#status').select2({
                placeholder: 'Seleccionar un estado',
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
                'Por favor, ingrese un número de teléfono'
            );

            jQuery.validator.addMethod(
                'emailExt',
                function (value, element) {
                    if (value === '') return true;
                    return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\\.,;:\s@\"]+\.)+[^<>()[\]\\.,;:\s@\"]{2,})$/i.test(value);
                },
                'Por favor, ingrese un correo electrónico válido.'
            );

            $("#formNotes").validate({
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
                        email: 'Por favor, ingrese un número de teléfono.',
                    },
                    phone: {
                        required: "El parametro es necesario.",
                        email: 'Por favor, ingrese un número de teléfono.',
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

                    var $form = $('#formNotes');
                    var formData = new FormData($form[0]);

                    var $submitButton = $('button[type="submit"]');
                    $submitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('teleoperator.notes.update') }}",
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



