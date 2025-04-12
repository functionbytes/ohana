@extends('layouts.managers')

@section('content')

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">

            <div class="card w-100">

                <form id="formSlider" enctype="multipart/form-data" role="form" onSubmit="return false">

                    {{ csrf_field() }}

                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="uid" name="uid" value="">
                    <input type="hidden" id="status" name="status" value="true">
                    <input type="hidden" id="edit" name="edit" value="true">
                    <input type="hidden" id="thumbnail" name="thumbnail">

                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">
                            <h5 class="mb-0">Imagen</h5>
                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para permitirte  <mark><code>introducir</code></mark> nueva información de manera sencilla y estructurada. A continuación, se presentan varios campos que deberás completar con los datos requeridos.
                        </p>
                        <div class="dropzone dz-clickable" id="thumbnail">
                            <div class="fallback">
                                <input type="file" hidden name="file">
                            </div>
                        </div>
                        <label id="thumbnail-error" class="error d-none" for="thumbnail"></label>
                    </div>

                    <div class="card-body border-top">
                        <div class="d-flex no-block align-items-center">
                            <h5 class="mb-0">Crear noticia</h5>
                        </div>
                        <p class="card-subtitle mb-3 mt-3">
                            Este espacio está diseñado para permitirte  <mark><code>introducir</code></mark> nueva información de manera sencilla y estructurada. A continuación, se presentan varios campos que deberás completar con los datos requeridos.
                        </p>

                        <div class="row">

                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Titulo</label>
                                        <input type="text" class="form-control" id="title"  name="title" value="" placeholder="Ingresar titulo">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Subtitulo</label>
                                        <input type="text" class="form-control" id="subtitle"  name="subtitle" value="" placeholder="Ingresar subtitulo">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Descripción</label>
                                        <input type="text" class="form-control" id="description"  name="description" value="" placeholder="Ingresar descripcion">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                        <label  class="control-label col-form-label">Link</label>
                                        <input type="text" class="form-control" id="url"  name="url" value="" placeholder="Ingresar link">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="control-label col-form-label">Ubicación</label>
                                    <div class="input-group">
                                        {!! Form::select('ubication', $ubications, null , ['class' => 'select2 form-control','id' => 'ubication']) !!}
                                    </div>
                                        <label id="ubication-error" class="error d-none" for="ubication"></label>
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

    Dropzone.autoDiscover = false;

        $(document).ready(function() {

            $("#formSlider").validate({
                submit: false,
                ignore: ".ignore",
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    url: {
                        required: false,
                        url: true,
                        minlength: 0,
                        maxlength: 1000,
                    },
                    subtitle: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    available: {
                        required: true,
                    },
                    ubication: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    thumbnail: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "El parámetro es necesario.",
                        minlength: "Debe contener al menos 3 caracteres.",
                        maxlength: "Debe contener menos de 100 caracteres.",
                    },
                    subtitle: {
                        required: "El parámetro es necesario.",
                        minlength: "Debe contener al menos 3 caracteres.",
                        maxlength: "Debe contener menos de 100 caracteres.",
                    },
                    url: {
                        required: "El parámetro es necesario.",
                        url: "Debe ingresar una URL válida.",
                        minlength: "Debe contener al menos 3 caracteres.",
                        maxlength: "Debe contener menos de 1000 caracteres.",
                    },
                    available: {
                        required: "Es necesario un estado.",
                    },
                    ubication: {
                        required: "Es necesaria una ubicación.",
                    },
                    description: {
                        required: "La descripción es necesaria.",
                    },
                    thumbnail: {
                        required: "Es necesario una imagen.",
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("id") == "thumbnail") {
                        error.insertAfter("#thumbnail");
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {

                    var $form = $('#formSlider');
                    var formData = new FormData($form[0]);
                    var slack = $("#slack").val();
                    var title = $("#title").val();
                    var subtitle = $("#subtitle").val();
                    var description = $("#description").val();
                    var ubication = $("#ubication").val();
                    var available = $("#available").val();

                    formData.append('slack', slack);
                    formData.append('title', title);
                    formData.append('subtitle', subtitle);
                    formData.append('subtitle', subtitle);
                    formData.append('ubication', ubication);
                    formData.append('description', description);
                    formData.append('available', available);

                    var $submitButton = $('button[type="submit"]');
                    $submitButton.prop('disabled', true);

                    $.ajax({
                        url: "{{ route('manager.sliders.store') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(response) {

                            if(response.success == true){

                                slack = response.slack;
                                $("#slack").val(slack);
                                myThumbnail.processQueue();

                                message = response.message;

                                toastr.success(message, "Operación exitosa", {
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right"
                                });

                                myThumbnail.on("queuecomplete", function() {
                                    setTimeout(function() {
                                        window.location = "{{ route('manager.sliders') }}";
                                    }, 2000);
                                });

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


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var myThumbnail = new Dropzone("div#thumbnail", {
                paramName: "file",
                url: "{{ route('manager.sliders.thumbnails') }}",
                method: 'POST',
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: false,
                acceptedFiles: "image/*",
                parallelUploads: 1,
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                init: function() {

                    var myDropzone = this;

                    item = $("#slack").val();

                    myDropzone.on("maxfilesexceeded", function(file) {
                        this.removeFile(file);
                    });

                    myDropzone.on('sending', function(file, xhr, formData) {
                        let slider = document.getElementById('slack').value;
                        formData.append('slider', slider);
                    });

                    myDropzone.on("addedfile", function(file) {
                        $("#thumbnail").val(file.name);
                        $("#formSlider").validate().element("#thumbnail");
                    });

                    myDropzone.on("removedfile", function(file) {
                        $("#thumbnail").val('');
                        $("#formSlider").validate().element("#thumbnail");
                        if (file.id) {
                            $.ajax({
                                type: 'GET',
                                url: "{{ route('manager.sliders.thumbnails.delete', ':id') }}".replace(':id', file.id),
                                success: function(result) {
                                    $("#status").val('false');
                                }
                            });
                        }
                    });

                    myDropzone.on('resetFiles', function() {
                        $("#status").val('false');
                        myDropzone.removeAllFiles();
                    });


                    myDropzone.on("success", function(file, response) {
                        $("#status").val('true');
                    });

                    myDropzone.on("queuecomplete", function() {

                    });

                }
            });


        });

    </script>

@endpush
