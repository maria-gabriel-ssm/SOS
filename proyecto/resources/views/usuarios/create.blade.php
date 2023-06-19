@extends('layouts.modal')
@section ('content')

{!! Form::open(array('route' => array('usuarios.update', Auth::user()->id),'method'=>'post','class'=>'container')) !!}
<div class="row mt-4">
    <div class="col-8">
    {!! Form::label('','Nombre') !!}
    {!! Form::label('nombre',Auth::user()->nombreCompleto,array('class' => 'form-control form-gray'))!!}
    </div>
    <div class="col-4">
        <label for="FormControlSelect">Sexo</label>
        <select class="form-control form-gray pointer" id="sexo" name="sexo">
            <option value="0">Seleccionar</option>
          <option value="1" {{ Auth::user()->sexo == '1' ? 'selected' : '' }} >Hombre</option>
          <option value="2" {{ Auth::user()->sexo == '2' ? 'selected' : '' }}>Mujer</option>
        </select>
    </div>
<div class="col-8 mt-2">
    {!! Form::label('','Area') !!}
    {{ Form::select('area', $cat_area, Auth::user()->area, ['class' => 'form-control form-gray','id'=>'cat_area','placeholder'=>'Seleccione un departamento','required'])}}
</div>
<div class="col-4 mt-2">
    {!! Form::label('','Teléfono') !!}
        {!! Form::text('telefono',Auth::user()->telefono,array('class' => 'form-control form-gray px-2', 'placeholder'=>'Teléfono ó extensión', 'required', 'pattern' => '[0-9]{4,10}', 'title'=> 'Ingresa minimo una extensión a cuatro dígitos'))!!}
</div>
</div>


<div class="card-body text-center mt-4">
    <button type="button" onclick="window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
    <button type="submit"class="btn {{$bg->custom}}">Guardar</button>
</div>
{!! Form::close() !!}

 <script type="text/javascript">
    $("#cat_area").select2({theme: 'bootstrap4'});

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