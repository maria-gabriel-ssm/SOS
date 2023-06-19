@extends('layouts.modal')
@section('content')
{!! Form::open(array('route' => array('conferencias.store', $conferencia),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container-fluid">
   <div class="row">
      @if($conferencia->estado==3)
      <small class="text-danger">La conferencia no se puede editar porque ha sido cancelada.</small>
      @endif
      @if($conferencia->estado==2)
      <small class="text-info">La conferencia ya no se puede editar porque ha sido agendada.</small>
      @endif
      @csrf
      <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Nombre') !!}
         {!! Form::text('nombre',$conferencia->usuario->nombreCompleto,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre completo', 'required', $conferencia->estado!=1 ? 'readonly' : ''))!!}
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Cargo') !!}
         <select class="form-control form-gray pointer" id="cargo" name="cargo" required {{$conferencia->estado!=1 ? 'disabled' : ''}}>
            <option value="">Seleccionar</option>
            <option value="Director" {{ $conferencia->cargo == 'Director' ? 'selected' : ''}}>Director</option>
            <option value="Subdirector" {{ $conferencia->cargo == 'Subdirector' ? 'selected' : ''}}>Subdirector</option>
            <option value="Jefe de departamento" {{ $conferencia->cargo == 'Jefe de departamento' ? 'selected' : ''}}>Jefe de departamento</option>
            <option value="Apoyo administrativo" {{ $conferencia->cargo == 'Apoyo administrativo' ? 'selected' : ''}}>Apoyo administrativo</option>
            <option value="Coordinador" {{ $conferencia->cargo == 'Coordinador' ? 'selected' : ''}}>Coordinador</option>
            <option value="Encargado" {{ $conferencia->cargo == 'Encargado' ? 'selected' : ''}}>Encargado</option>
         </select>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Dirección') !!}
         {{ Form::select('direccion', $cat_dir, $conferencia->id_dir, ['class' => 'form-control form-gray','id'=>'cat_dir','placeholder'=>'Seleccione una dirección','required', $conferencia->estado!=1 ? 'disabled' : ''])}}
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Subdirección') !!}
         {{ Form::select('subdireccion', $cat_sub, $conferencia->id_sub, ['class' => 'form-control form-gray','id'=>'cat_sub','placeholder'=>'Seleccione una subdirección', $conferencia->estado!=1 ? 'disabled' : ''])}}
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Departamento') !!}
         {{ Form::select('departamento', $cat_dep, $conferencia->id_dep, ['class' => 'form-control form-gray','id'=>'cat_dep','placeholder'=>'Seleccione un departamento', $conferencia->estado!=1 ? 'disabled' : ''])}}
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','E-mail') !!}
         {!! Form::text('email',$conferencia->usuario->email,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese su correo electrónico', 'required', $conferencia->estado!=1 ? 'readonly' : ''))!!}
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Teléfono extensión') !!}
         {!! Form::text('telefono',$conferencia->usuario->telefono,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Extensión IP', 'required', 'pattern' => '[0-9]{4,10}', 'title'=> 'Ingresa minimo una extensión a cuatro dígitos', $conferencia->estado!=1 ? 'readonly' : ''))!!}
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
         {!! Form::label('','Celular') !!}
         {!! Form::text('celular',$conferencia->celular,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese un número de celular', 'required','pattern' => '[0-9]{10}', 'title'=> 'Ingresa minimo 10 dígitos', $conferencia->estado!=1 ? 'readonly' : ''))!!}
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Inicio') !!}
               <!-- {!! Form::text('ini',$conferencia->feini,array('class' => 'form-control form-gray px-2', 'id' => 'ini','placeholder'=>'Ingrese una fecha', 'required'))!!} -->
               @if($conferencia->estado==1)
               {{ Form::input('dateTime-local', 'ini', $conferencia->feini, ['id' => 'ini', 'class' => 'form-control form-gray px-2']) }}
               @else
               {{ Form::input('text', 'ini', $conferencia->feini, ['id' => 'ini', 'class' => 'form-control form-gray px-2', 'readonly']) }}
               @endif
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Fin') !!}
               <!-- {!! Form::text('fin','',array('class' => 'form-control form-gray px-2', 'id' => 'fin','placeholder'=>'Ingrese una fecha', 'required'))!!} -->
               @if($conferencia->estado==1)
               {{ Form::input('dateTime-local', 'fin', $conferencia->fefin, ['id' => 'fin', 'class' => 'form-control form-gray px-2']) }}
               @else
               {{ Form::input('text', 'ini', $conferencia->fefin, ['id' => 'ini', 'class' => 'form-control form-gray px-2', 'readonly']) }}
               @endif
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Tipo evento') !!}
               <select class="form-control form-gray pointer" id="tipo" name="tipo" required {{$conferencia->estado!=1 ? 'disabled' : ''}}>
                <option value="">Seleccionar</option>
                <option value="Capacitación" {{ $conferencia->tipo == 'Capacitación' ? 'selected' : ''}}>Capacitación</option>
                <option value="Administrativo" {{ $conferencia->tipo == 'Administrativo' ? 'selected' : ''}}>Administrativo</option>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                {!! Form::label('','Programa (en caso de aplicar)') !!}
                {!! Form::text('programa',$conferencia->programa,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre del programa', $conferencia->estado!=1 ? 'readonly' : ''))!!}
              </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
               {!! Form::label('','Nombre del evento') !!}
               {!! Form::text('evento',$conferencia->nombre,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre completo', 'required', $conferencia->estado!=1 ? 'readonly' : ''))!!}
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Sede emisora') !!}
               {{ Form::select('sede', $cat_sed, $conferencia->sede, ['class' => 'form-control form-gray','id'=>'cat_sed','placeholder'=>'Seleccione una sede','required', $conferencia->estado!=1 ? 'disabled' : ''])}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               {!! Form::label('','Lugar de emisión') !!}
               {!! Form::text('emision',$conferencia->emision,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese una fecha', 'required', $conferencia->estado!=1 ? 'readonly' : ''))!!}
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 mt-3">
               {!! Form::label('','Sedes participantes') !!}
               {{ Form::select('receptores[]', $cat_sed, $receps, ['class' => 'form-control form-gray px-2','id'=>'cat_rec','required','multiple' =>'multiple', $conferencia->estado!=1 ? 'disabled' : ''])}}
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
               {!! Form::label('','No. participantes') !!}
               {!! Form::number('participantes',$conferencia->participantes,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese el número', 'required', $conferencia->estado!=1 ? 'readonly' : ''))!!}
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
               {!! Form::label('','Comentarios') !!}
               {!! Form::textarea('comentarios',$conferencia->comentarios,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Ingrese comentarios a la solicitud', 'required', 'rows'=>'2', $conferencia->estado!=1 ? 'readonly' : ''))!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
               <div class="form-check form-switch ps-0 is-filled">
                  <input class="form-check-input ms-auto" type="checkbox" id="grabar" name="grabar" {{ $conferencia->grabar == 1 ? 'checked' : ''}} {{$conferencia->estado!=1 ? 'disabled' : ''}}>
                  <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Grabar videoconferencia</label>
                </div>
            </div>
      <br>
      <input type="hidden" name="id" value="{{$conferencia->id}}">
      <input type="hidden" name="id_user" value="{{$conferencia->id_user}}">
   </div>
   <div class="form-group row mb-0 text-center mt-4">
      <div class="col-12">
         <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
         <button type="submit" class="btn {{$bg->custom}} {{$conferencia->estado!=1 ? 'd-none' : ''}}" {{$conferencia->estado!=1 ? 'disabled' : ''}}>
         Guardar
         </button><br><br>
      </div>
   </div>
</div>
{!! Form::close() !!}
<script type="text/javascript">
   localStorage.setItem('res','');
    @if(session('ok'))
    localStorage.setItem('res','ok');
    window.parent.closeModal();
    @elseif(session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
    @endif
</script>
@endsection