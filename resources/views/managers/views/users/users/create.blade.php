@extends('layouts.managers')

@section('content')

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">

            <div class="card w-100">

                <form id="formUsers" enctype="multipart/form-data" role="form" onSubmit="return false">

                    {{ csrf_field() }}

                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="uid" name="uid" value="">
                    <input type="hidden" id="edit" name="edit" value="true">

                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">

                            <h5 class="mb-0">Crear usuario
                            </h5>

                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para que puedas actualizar y modificar la información de manera eficiente y segura. A continuación, encontrarás diversos <mark><code>campos</code></mark> que corresponden a los datos previamente suministrados. Te invitamos a revisar y ajustar cualquier información que consideres necesario actualizar para mantener tus datos al día.
                        </p>

                        <div class="row">

                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Nombres</label>
                                        <input type="text" class="form-control" id="firstname"  name="firstname" value="" placeholder="Ingresar nombres" autocomplete="new-password">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Apellidos</label>
                                        <input type="text" class="form-control" id="lastname"  name="lastname" value="" placeholder="Ingresar apellido" autocomplete="new-password">

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Correo electronico</label>
                                        <input type="text" class="form-control" id="email"  name="email" value="" placeholder="Ingresar correo electronico" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password"  name="password" value="" placeholder="Ingresar contraseña" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-6 divInventaries ">
                                <div class="mb-3">
                                    <label class="control-label col-form-label">Tiendas</label>
                                    <div class="input-group">
                                        {!! Form::select('shops', $shops, null , ['class' => 'select2 form-control','id' => 'shops']) !!}
                                    </div>
                                    <label id="shops-error" class="error d-none" for="shops"></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="control-label col-form-label">Estado</label>
                                    <div class="input-group">
                                        {!! Form::select('available', $availables, null , ['class' => 'select2 form-control','id' => 'available']) !!}
                                    </div>
                                    <label id="available-error" class="error d-none" for="available"></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="control-label col-form-label">Perfil</label>
                                    <div class="input-group">
                                        {!! Form::select('role', $roles, null , ['class' => 'select2 form-control','id' => 'roles']) !!}
                                    </div>
                                    <label id="roles-error" class="error d-none" for="roles"></label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="errors d-none">
                                </div>
                            </div>
                            <div class="col-12">
                            <div class="border-top pt-1 mt-4">
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

        $(document).ready(function() {

            $('#roles').change(function(e) {

                e.preventDefault();
                var role = $(this).val();

                if (role == 2) {
                    $('.divInventaries').removeClass("d-none");
                } else {
                    $('.divInventaries').addClass("d-none");
                }

            });

            jQuery.validator.addMethod(
                'emailExt',
                function (value, element, param) {
                    return value.match(
                        /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i,
                    )
                },
                'Porfavor ingrese email valido',
            );

            $("#formUsers").validate({
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
                    email: {
                        required: true,
                        email: true,
                        emailExt: true,
                    },
                    password: {
                        required: false,
                        minlength: 3,
                        maxlength: 100,
                    },
                    available: {
                        required: true,
                    },
                    role: {
                        required: true,
                    },
                    shop: {
                        required: false,
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
                    cellphone: {
                        required: "El parametro es necesario.",
                        number: 'Solo se puede ingresar números.',
                        minlength: "Debe contener al menos 6 caracter",
                        maxlength: "Debe contener al menos 10 caracter",
                    },
                    available: {
                        required: "Es necesario un estado.",
                    },
                    role: {
                        required: "Es necesario un estado.",
                    },
                    email: {
                        required: 'Tu email ingresar correo electrónico es necesario.',
                        email: 'Por favor, introduce una dirección de correo electrónico válida.',
                    },
                    password: {
                        required: "El parametro es necesario.",
                        minlength: "Debe contener al menos 6 caracter",
                        maxlength: "Debe contener al menos 10 caracter",
                    },
                },
                submitHandler: function(form) {

                    var $form = $('#formUsers');
                    var formData = new FormData($form[0]);
                    var slack = $("#slack").val();
                    var firstname = $("#firstname").val();
                    var lastname = $("#lastname").val();
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var available = $("#available").val();
                    var role = $("#roles").val();
                    var shop = $("#shops").val();

                    formData.append('slack', slack);
                    formData.append('firstname', firstname);
                    formData.append('lastname', lastname);
                    formData.append('email', email);
                    formData.append('password', password);
                    formData.append('available', available);
                    formData.append('role', role);
                    formData.append('shop', shop);

                    var $submitButton = $('button[type="submit"]');
                    $submitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('manager.users.store') }}",
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
                                    window.location.href = "{{ route('manager.users') }}";
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



