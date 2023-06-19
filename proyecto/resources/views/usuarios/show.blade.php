@extends('layouts.modal')
@section ('content')

{!! Form::open(array('route' => array('usuarios.store',$usuario),'method'=>'post','class'=>'container')) !!}
<div class="row mt-4">
    <div class="col-12">
    {!! Form::label('','Nombre') !!}
    {!! Form::text('nombre',$usuario->nombre,array('class' => 'form-control form-gray'))!!}
    </div>
  
<div class="col-6 mt-2">
    {!! Form::label('','Apellido paterno') !!}
    {!! Form::text('apepa',$usuario->apepa,array('class' => 'form-control form-gray'))!!}
</div>
<div class="col-6 mt-2">
    {!! Form::label('','Apellido materno') !!}
    {!! Form::text('apema',$usuario->apema,array('class' => 'form-control form-gray'))!!}
</div>
<div class="col-6 mt-2">
    {!! Form::label('','Username') !!}
    {!! Form::label('username',$usuario->username,array('class' => 'form-control form-gray'))!!}
</div>
<div class="col-6 mt-2">
    {!! Form::label('','Tipo de usuario') !!}
    {!! Form::label('tipo',$usuario->tipo_usuario==1 ? 'Normal' : 'Administrador',array('class' => 'form-control form-gray'))!!} 
</div>
</div>


<div class="card-body text-center mt-4">
    <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
    @env('usuarios.edit')
    <button type="submit"class="btn {{$bg->custom}}">Guardar</button>
    @endenv
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