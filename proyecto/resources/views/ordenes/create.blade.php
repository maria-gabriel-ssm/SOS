@extends('layouts.modal')

@section('content')
  {!! Form::open(array('route' => array('orden.store', ''),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container">
    <div class="row">
        @csrf
    <div class="col-lg-8 col-md-8 col-sm-12 mt-0">
        {!! Form::label('','Area') !!}
        {{ Form::select('area', $cat_area, '', ['class' => 'form-control form-gray','id'=>'cat_area','placeholder'=>'Seleccione un departamento','required'])}}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
        {!! Form::label('','Nombre') !!}
        {!! Form::text('name','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Nombre', 'required'))!!}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
        {!! Form::label('','Usuario') !!}
        {{ Form::select('usuario', $cat_user, '', ['class' => 'form-control form-gray','id'=>'cat_user','placeholder'=>'Seleccione usuario','required'])}}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
        {!! Form::label('','Tarea') !!}
        {{ Form::select('tarea', $cat_tarea, '', ['class' => 'form-control form-gray','id'=>'cat_tarea','placeholder'=>'Seleccione tarea solicitada','required'])}}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
        {!! Form::label('','Equipo') !!}
        {{ Form::select('equipo', $cat_equipo, '', ['class' => 'form-control form-gray','id'=>'cat_equipo','placeholder'=>'Seleccione tipo de equipo','required'])}}
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 mt-2">
        {!! Form::label('','Descripción') !!}
        {!! Form::textarea('descripcion','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Favor de ingresar una descripción sólida.', 'rows' => 1, 'required'))!!}
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 mt-2">
        {!! Form::label('','Teléfono') !!}
        {!! Form::text('telefono','',array('class' => 'form-control form-gray px-2', 'placeholder'=>'Teléfono ó extensión', 'required'))!!}
    </div>
    <br>
    
            </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn {{$bg->custom}}">
                                    Crear
                                </button><br><br>
                            </div>
                        </div>
                        
                
        </div>
    
  {!! Form::close() !!}

  <script type="text/javascript">
    $("#cat_area").select2({theme: 'bootstrap4'});
    $("#cat_tarea").select2({theme: 'bootstrap4'});  
    $("#cat_equipo").select2({theme: 'bootstrap4'});
    $("#cat_user").select2({theme: 'bootstrap4'});

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

