@extends('layouts.plantilla')
@section('content')
<div class="container-fluid card p-4">
   {!! Form::open(array('route' => array('conferencias.store',$conferencia),'method'=>'post','class'=>'container', 'id'=>'myform')) !!}
   @csrf
   <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
         <a class="nav-item nav-link active" id="nav-uno-tab" data-toggle="tab" href="#nav-uno" role="tab" aria-controls="nav-uno" aria-selected="true">Solicitante</a>
         <a class="nav-item nav-link" id="nav-dos-tab" data-toggle="tab" href="#nav-dos" role="tab" aria-controls="nav-dos" aria-selected="false">Conferencia</a>
         <a class="nav-item nav-link" id="nav-tres-tab" data-toggle="tab" href="#nav-tres" role="tab" aria-controls="nav-tres" aria-selected="false">Detalles</a>
      </div>
   </nav>
   <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-uno" role="tabpanel" aria-labelledby="nav-uno-tab">
         <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Nombre') !!}
               {!! Form::text('nombre',Auth::user()->nombreCompleto,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre completo', 'required'))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Cargo') !!}
               <select class="form-control form-gray pointer" id="cargo" name="cargo" required>
                <option value="">Seleccionar</option>
                <option value="Director">Director</option>
                <option value="Subdirector">Subdirector</option>
                <option value="Jefe de departamento">Jefe de departamento</option>
                <option value="Apoyo administrativo">Apoyo administrativo</option>
                <option value="Coordinador">Coordinador</option>
                <option value="Encargado">Encargado</option>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Dirección') !!}
               {{ Form::select('direccion', $cat_dir, '', ['class' => 'form-control form-gray','id'=>'cat_dir','placeholder'=>'Seleccione una dirección','required'])}}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Subdirección') !!}
               {{ Form::select('subdireccion', $cat_sub, '', ['class' => 'form-control form-gray','id'=>'cat_sub','placeholder'=>'Seleccione una subdirección','required','disabled'])}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Departamento') !!}
               {{ Form::select('departamento', $cat_dep, '', ['class' => 'form-control form-gray','id'=>'cat_dep','placeholder'=>'Seleccione un departamento','required','disabled'])}}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','E-mail') !!}
               {!! Form::text('email',Auth::user()->email,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese su correo electrónico', 'required'))!!}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Teléfono extensión') !!}
               {!! Form::text('telefono',Auth::user()->telefono,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Extensión IP', 'required', 'pattern' => '[0-9]{4,10}', 'title'=> 'Ingresa minimo una extensión a cuatro dígitos'))!!}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Celular') !!}
               {!! Form::text('celular','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese un número de celular', 'required','pattern' => '[0-9]{10}', 'title'=> 'Ingresa minimo 10 dígitos'))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-white d-flex align-self-end mt-3">
               <button type="submit" id="nav2" class="btn {{$bg->custom}} btn-block m-0 pt-sm-2">Siguiente</button>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="nav-dos" role="tabpanel" aria-labelledby="nav-dos-tab">
         <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Fecha y hora inicio') !!}
               {{ Form::input('dateTime-local', 'ini', '', ['id' => 'ini', 'class' => 'form-control form-gray px-2']) }}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Fecha y hora fin') !!}
               {{ Form::input('dateTime-local', 'fin', '', ['id' => 'fin', 'class' => 'form-control form-gray px-2']) }}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Tipo evento') !!}
               <select class="form-control form-gray pointer" id="tipo" name="tipo" required>
                <option value="">Seleccionar</option>
                <option value="Capacitación">Capacitación</option>
                <option value="Administrativo">Administrativo</option>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Nombre del evento') !!}
               {!! Form::text('evento','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre completo', 'required'))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Sede emisora') !!}
               {{ Form::select('sede', $cat_sed, '', ['class' => 'form-control form-gray','id'=>'cat_sed','placeholder'=>'Seleccione una sede','required'])}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Lugar de emisión') !!}
               {!! Form::text('emision','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese una fecha', 'required'))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-white d-flex align-self-end mt-3">
               <button type="submit" id="nav3" class="btn {{$bg->custom}} btn-block m-0 pt-sm-2">Siguiente</button>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="nav-tres" role="tabpanel" aria-labelledby="nav-tres-tab">
         <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Sedes receptoras') !!}
               {{ Form::select('receptores[]', $cat_sed, '', ['class' => 'form-control form-gray px-2','id'=>'cat_rec','required','multiple' =>'multiple'])}}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3 mr-2">
               {!! Form::label('','No. participantes') !!}
               {!! Form::number('participantes','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese el número', 'required'))!!}
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mt-3 mr-2">
               {!! Form::label('','Comentarios') !!}
               {!! Form::textarea('comentarios','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese comentarios a la solicitud', 'required', 'rows'=>'2'))!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               <div class="form-check form-switch ps-0 is-filled">
                  <input class="form-check-input ms-auto" type="checkbox" id="grabar" name="grabar">
                  <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Grabar videoconferencia</label>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 text-white d-flex align-self-end mt-3">
               <button type="submit" class="btn {{$bg->custom}} btn-block m-0 pt-sm-2 nav-link">Finalizar</button>
            </div>
         </div>
      </div>
   </div>
   <br>
   {!! Form::close() !!}
</div>

<script type="text/javascript" src="{{ URL::asset('js/table.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

<script type="text/javascript">
   $("#titulo").text('Solicitud de Videoconferencias');

   $("#nav2").click(function(e){
      console.log($('#cat_dir').val());
      if($('input[name=celular]').val().length >= 10 && $('input[name=telefono]').val().length >= 4 && $('input[name=email]').val()!='' && $('input[name=nombre]').val()!='' && $('#cargo').val() !== null && $('#cargo').val() !== '' && $('#cat_dep').val() !== null && $('#cat_dep').val() !== '' && $('input[name=evento]').val()=='' && $('textarea[name=comentarios]').val()==''){
      $('#nav-dos-tab').trigger('click');
   }
   });
  $("#nav3").click(function(e){
      if($('input[name=evento]').val()!='' && $('input[name=emision]').val()!='' && $('#tipo').val() !== null && $('#tipo').val() !== '' && $('#sede').val() !== null && $('#sede').val() !== '' && $('input[name=celular]').val()!='' && $('textarea[name=comentarios]').val()==''){
      $('#nav-tres-tab').trigger('click');
   }
   });
   
   @if (session('ok'))
   setTimeout(() => {
       $("#successToast").toast("show");
   }, 200);
   @endif
   @if (session('nook'))
   setTimeout(() => {
       $("#dangerToast").toast("show");
   }, 200);
   @endif
</script>
@endsection