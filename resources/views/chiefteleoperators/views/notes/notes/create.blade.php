@extends('layouts.teleoperators')

@section('content')

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">

            <div class="card w-100">

                <form id="formCustomers" enctype="multipart/form-data" role="form" onSubmit="return false">

                    {{ csrf_field() }}


                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">

                            <h5 class="mb-0 uppercase">Crear cliente
                            </h5>

                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para que puedas actualizar y modificar la información de manera eficiente y segura. A continuación, encontrarás diversos <mark><code>campos</code></mark> que corresponden a los datos previamente suministrados. Te invitamos a revisar y ajustar cualquier información que consideres necesario actualizar para mantener tus datos al día.
                        </p>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Nombres</label>
                                <input type="text" class="form-control"  name="firstname" value="" placeholder="Ingresar nombres"  autocomplete="new-password">
                            </div>
                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Apellidos</label>
                                <input type="text" class="form-control" name="lastname" value="" placeholder="Ingresar apellidos" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Identificacion</label>
                                <input type="text" class="form-control" name="identification" value="" placeholder="Ingresar la identificacion" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Telefono</label>
                                <input type="text" class="form-control"  name="cellphone" value="" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Telefono (opcional)</label>
                                <input type="text" class="form-control"  name="phone" value="" placeholder="Ingresar el celular" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Iban</label>
                                <input type="text" class="form-control"  name="iban" value="" placeholder="Ingresar el iban" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label  class="control-label col-form-label">Correo electronico</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="Ingresar el correo electronico" autocomplete="new-password">
                            </div>

                            <div class="col-6 mb-3">
                                <label for="prioritie" class="control-label col-form-label">Codigo postal</label>
                                <select class="form-control select2" id="postalcode" name="postalcode">
                                    @foreach($postalcodes as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label id="postalcode-error" class="error" for="postalcode" style="display: none"></label>
                            </div>


                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Direccion principal</label>
                                <input type="text" class="form-control"  name="address" value="" placeholder="Ingresar la direccion" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Direccion secundaria</label>
                                <input type="text" class="form-control"  name="secondaddress" value="" placeholder="Ingresar la direccion" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Parroquia  (opcional)</label>
                                <input type="text" class="form-control"  name="parish" value="" placeholder="Ingresar la parroquia" autocomplete="new-password">
                            </div>

                            <div class="col-12 mb-3">
                                <label  class="control-label col-form-label">Observaciones</label>
                                <textarea type="text" class="form-control"  name="comments"  autocomplete="new-password"></textarea>
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

            jQuery.validator.addMethod(
                'cellphone',
                function (value, element) {
                    return this.optional(element) || /^(6|7)[0-9]{8}$/.test(value);
                },
                'Por favor, ingrese un número de teléfono'
            );
            jQuery.validator.addMethod(
                'emailExt',
                function (value, element, param) {
                    return value.match(
                        /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
                    )
                },
                'Porfavor ingrese email valido',
            );

            jQuery.validator.addMethod(
                'iban',
                function (value, element) {
                    return this.optional(element) || /^ES\d{22}$/.test(value.toUpperCase());
                },
                'Por favor, introduce un IBAN válido de España (24 caracteres, comenzando con ES)'
            );

            $("#formCustomers").validate({
                submit: false,
                ignore: ".ignore",
                rules: {
                    firstname: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    lastname: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    identification: {
                        required: false,
                        minlength: 1,
                        maxlength: 9,
                    },
                    email: {
                        required: false,
                        email: true,
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
                        required: true,
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
                    iban: {
                        required: false,
                        iban: true,
                    },
                    postalcode: {
                        required: true,
                    },

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
                    iban: {
                        required: "El parametro es necesario.",
                        email: 'Por favor, introduce un IBAN válido de España (24 caracteres, comenzando con ES)',
                    },
                    postalcode: {
                        required: "El parametro es necesario.",
                    },
                },
                submitHandler: function(form) {

                    var $form = $('#formCustomers');
                    var formData = new FormData($form[0]);

                    var $submitButton = $('button[type="submit"]');
                    $submitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('teleoperator.customers.store') }}",
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
                                    window.location.href = "{{ route('teleoperator.customers') }}";
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



