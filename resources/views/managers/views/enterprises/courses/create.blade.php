@extends('layouts.managers')

@section('content')

<div class="row">
  <div class="col-lg-12 d-flex align-items-stretch">

    <div class="card w-100">

      <form id="formCourse" enctype="multipart/form-data" role="form" onSubmit="return false">

        {{ csrf_field() }}

        <input id="enterprise" name="enterprise" type="hidden" value="{{ $enterprise->uid }}">

        <div class="card-body border-top">
          <div class="d-flex no-block align-items-center">
            <h5 class="mb-0"> Asignar curso</h5>

          </div>
          <p class="card-subtitle mb-3 mt-3">
            Este espacio está diseñado para que puedas actualizar y modificar la información de manera eficiente y
            segura. A continuación, encontrarás diversos <mark><code>campos</code></mark> que corresponden a los datos
            previamente suministrados. Te invitamos a revisar y ajustar cualquier información que consideres necesario
            actualizar para mantener tus datos al día.
          </p>

          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label  class="control-label col-form-label">Empresa</label>
                <div class="input-group">
                  <input type="text" class="form-control" value="{{ $enterprise->title }}" placeholder="Ingresar celular"
                    disabled>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label  class="control-label col-form-label">Cursos</label>
                <div class="input-group">
                  {!! Form::select('course', $courses, null , ['class' => 'select2 form-control' ,'name' => 'course',
                  'id' => 'course' ]) !!}
                </div>
                <label id="course-error" class="error d-none" for="course"></label>
              </div>
            </div>
              <div class="col-12">
                  <div class="action-form border-top mt-4">
                      <div class="text-center">
                          <button type="submit" class="btn btn-info  px-4 waves-effect waves-light mt-2 w-100">
                              Guardar
                          </button>
                      </div>
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

            $("#formCourse").validate({
                submit: false,
                ignore: ".ignore",
                rules: {
                    course: {
                        required: true,
                    },
                    'user[]': {
                        required: true,
                    },
                },
                messages: {
                    course: {
                        required: "Es necesario una opción.",
                    },
                    'user[]': {
                        required: "Es necesario una opción.",
                    },
                },
                submitHandler: function(form) {

                    var $form = $('#formCourse');
                    var formData = new FormData($form[0]);
                    var slack = $("#slack").val();
                    var old = $("#old").val();
                    var enterprise = $("#enterprises").val();
                    var user = $("#user").val();

                    formData.append('slack', slack);
                    formData.append('old', old);
                    formData.append('enterprises', enterprise);
                    formData.append('user', user);

                    $.ajax({
                        url: "/manager/enterprises/courses/create/store",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function(d) {

                            window.location.href = "{{ route('manager.enterprises.courses',  $enterprise->uid ) }}";
                        }
                    });

                }

            });




        });

</script>



@endpush
