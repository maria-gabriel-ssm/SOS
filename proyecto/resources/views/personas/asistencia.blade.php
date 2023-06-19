@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => array('personas.registro'),'method'=>'post','class'=>'container')) !!}
  <div class="row justify-content-center text-center">
    <div class="col-lg-4 col-md-4 col-sm-12 mt-3 mr-2">
      <h1 style="font-size: 24px; font-weight: bold; margin-top: 20px">Registro de asistencia</h1>
      <h5><b>{{$confe->nombre}}</b></h5>
      <p style="font-size: 14px;">Favor de completar el siguiente formulario para ingresar a la videoconferencia:</p>
      <div id="alert" class="col-12 mt-3 mr-2">
       <div class="alert alert-danger-opacity my-2" role="alert">
            Tu correo ya se encuentra registrado en esta conferencia, da click al siguiente boton para ingresar a la reunión.
          </div>
          <a href="{{$confe->link}}" class="btn btn-platzi btn-block text-white bg-gradient-{{$bg->customcolor}} text-capitalize">Unirme</a>
      </div>
      <div id="form" class="row">
        <div class="col-12 mt-3 mr-2">
       {!! Form::email('email','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'E-mail', 'required', 'id' => 'email'))!!}
      </div>
      <div class="col-12 mt-3 mr-2">
       {!! Form::text('nombre','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre', 'required'))!!}
       </div>
       <div class="col-12 mt-3 mr-2">
       {!! Form::text('apepa','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Apellido paterno', 'required'))!!}
       </div>
       <div class="col-12 mt-3 mr-2">
       {!! Form::text('apema','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Apellido materno', 'required'))!!}
      </div>
      <div class="col-12 mt-3 mr-2">
       {!! Form::text('area','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Area referente', 'required'))!!}
       </div>
      <div class="col-12 mt-3 mr-2">
       {!! Form::text('cargo','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Cargo correspondiente', 'required'))!!}
       </div>
      <div class="col-12 mt-3 mr-2">
       {!! Form::text('telefono','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Teléfono', 'required', 'pattern' => '[0-9]{4,10}', 'title'=> 'Ingresa un número telefónico'))!!}
      </div>
      <input type="hidden" name="id" value="{{$confe->id}}">
      <input type="hidden" name="link" value="{{$confe->link}}">
      <div class="col-12 mt-3 mr-2">
      <button type="submit" class="btn btn-platzi btn-block text-white bg-gradient-{{$bg->customcolor}} text-capitalize">Guardar</button>
        </div>
      </div>
      <br>
      <img alt="Inspect with Tabs" src="https://www.ssm.gob.mx/portal/img/ssm_logo_OK.png" style="width: 50%;">
      <p class="text-muted">© Servicios de Salud Morelos <script>
                  document.write(new Date().getFullYear())
                </script></p> 
      </div>
    </div>
<script type="text/javascript">
  $('#alert').hide();
  $("body").css({"overflow": "auto"});

  $("#email").on('focusout',function(){ 
       @foreach($resper as $key => $res)
        var mail2 = "<?php echo $res; ?>";
        var mail =  $("#email").val();
        if (mail == mail2) {
          $('#alert').show();
          $('#form').hide();
        }
       @endforeach
   });
</script>
@endsection
