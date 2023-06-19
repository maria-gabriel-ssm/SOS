@extends('layouts.modal')
@section ('content')

<style type="text/css">
    .form-gray{
        background-color: #f0f2f5 !important;
        border: none !important;
    }
</style>

{!! Form::open(array('route' => array('cancelaciones.store',$cancelacion),'method'=>'post','class'=>'container','id'=>'formi')) !!}
<div class="row mt-5">
    <div class="col-12">
    <p class="text-sm text-center pb-3"> *A continuación describe el motivo de por qué deseas <b>cancelar</b> o <b>reagendar</b> la videoconferencia (en caso de reagendar favor de escribir las fechas). Se hará llegar un correo al administrador.</p>
    {!! Form::textarea('comentario', $comentario ? $comentario->comentario : '' ,array('class' => 'form-control form-gray p-2', 'placeholder'=>'Ingrese un comentario', 'rows' => 5, 'required'))!!}
    </div>
    <div id="alert" class="alert alert-danger-opacity text-sm my-1 mx-4" role="alert" style="display: none">
            Ingrese un comentario a la solicitud.
        </div>
        <div id="alert2" class="row justify-content-center mt-4" style="display: none">
          <div class="col-1">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>
      <span class="text-xs text-center text-primary">Enviando...</span>
  </div>
</div>

<div class="card-body text-center">
    <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
    @if(!$comentario)
    <button id="btn" type="button"class="btn {{$bg->custom}}">Enviar</button>
    @endif
</div>
{!! Form::close() !!}

<script type="text/javascript">

    $('#btn').on('click',function(event){
      if($('textarea[name=comentario]').val()!=''){
        $('#btn').prop('disabled', true);
        $('#alert2').show();
        $('#formi').submit();
        }else{
          $('#alert').fadeIn('slow').delay(3500).hide(0);
      }
    });
    
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