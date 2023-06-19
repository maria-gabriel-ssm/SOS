@extends('layouts.modal')

<style type="text/css">
    .form-gray{
        background-color: #f0f2f5 !important;
        border: none !important;
    }
    .select2-container--bootstrap4{
        color: inherit !important;
    }
    .select2-selection{
        background-color: #f0f2f5 !important;
        border: none !important;
    }
</style>
@section('content')
  {!! Form::open(array('route' => array('historial.store'),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container">
    <div class="row justify-content-center">
                        @csrf
    <div class="col-7 mt-3">
        {!! Form::label('','Encargado nuevo') !!}
        {{ Form::select('usuario', $usuario, '', ['class' => 'form-control form-gray','id'=>'usuario','placeholder'=>'Seleccione un técnico','required'])}}
    </div>
    <div class="col-7 mt-3">
        {!! Form::label('','Encargado anterior') !!}
        {!! Form::text('old',$old->nombreCompleto ?? 'Sin asignar',array('class' => 'form-control form-gray', 'placeholder'=>'Anterior', 'required', 'readonly'))!!}    
    </div>
    <input type="hidden" name="id_old" value="{{$old->id ?? ''}}">
    <input type="hidden" name="id_orden" value="{{$id_orden->id}}">
    <br>
    
            </div>
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn {{$bg->custom}}">
                                    Asignar
                                </button><br><br>
                            </div>
                        </div>
                        
                
        </div>
    
  {!! Form::close() !!}

<script type="text/javascript">
    $("#usuario").select2({theme: 'bootstrap4'});
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

