@extends('layouts.modal')

@section('content')
  {!! Form::open(array('route' => array('orden.store', $orden),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container">
    <div class="row">
    @csrf
    <div class="col-7 mt-0">
        {!! Form::label('','Area') !!}
        {{ Form::select('area', $cat_area, $orden->id_area, ['class' => 'form-control form-gray','id'=>'cat_area','placeholder'=>'Seleccione un departamento','required'])}}
    </div>
    <div class="col-7 mt-2">
        {!! Form::label('','Nombre') !!}
        {!! Form::text('name',$orden->name,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre', 'required'))!!}
    </div>
    <div class="col-5 mt-2">
        {!! Form::label('','Usuario') !!}
        {{ Form::select('usuario', $cat_user, $orden->id_user, ['class' => 'form-control form-gray','id'=>'cat_user','placeholder'=>'Seleccione usuario','required'])}}
    </div>
    <div class="col-7 mt-2">
        {!! Form::label('','Tarea') !!}
        {{ Form::select('tarea', $cat_tarea, $orden->id_tarea, ['class' => 'form-control form-gray','id'=>'cat_tarea','placeholder'=>'Seleccione tarea solicitada','required'])}}
    </div>
    <div class="col-5 mt-2">
        {!! Form::label('','Equipo') !!}
        {{ Form::select('equipo', $cat_equipo, $orden->equipo, ['class' => 'form-control form-gray','id'=>'cat_equipo','placeholder'=>'Seleccione tipo de equipo','required'])}}
    </div>
    <div class="col-8 mt-2">
        {!! Form::label('','Descripción') !!}
        {!! Form::textarea('descripcion',$orden->descripcion,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Favor de ingresar una descripción sólida.', 'rows' => 1, 'required'))!!}
    </div>
    <div class="col-4 mt-2">
        {!! Form::label('','Teléfono') !!}
        {!! Form::text('telefono',$orden->telefono,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Teléfono ó extensión', 'required'))!!}
    </div>
    <br>
    
            </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn {{$bg->custom}}">
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

