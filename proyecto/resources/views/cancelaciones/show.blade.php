@extends('layouts.modal')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-6">
            {!! Form::open(array('route' => array('cancelaciones.store',$cancelacion),'method'=>'post','class'=>'container', 'id'=>'formi')) !!}
            @csrf
            <div class="form-group row m-0">
                <h6 class="mb-3 text-sm">
                    <img src="{{URL::asset('/image/avatar/mns.gif')}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    Solicitud de cancelación / reagendación
                    <span class="float-right" href="javascript:;"><i class="material-icons text-sm me-2">event</i>
                        @if(empty($comentario->created_at))
                        NA
                        @else
                        {{$comentario->created_at->format('d/m/Y')}}
                        @endif
                    </span>
                </h6>

                <span class="mb-2 text-xs">El usuario desea cancelar o reagendar por el siguiente motivo:</span>
                {!! Form::textarea('', $comentario ? $comentario->comentario : 'No se ha solicitado cancelación' ,array('class' => 'form-control form-gray text-sm p-2', 'rows' => 3, 'readonly'))!!}
                <input id="operacion" type="hidden" name="operacion" value="">
                <br>
                <a href="#" id="rec" class="text-xs opacity-8 mt-2 pl-1 {{$comentario ? 'd-none' : ''}}" style="text-decoration: underline;">Cancelar solicitud</a>
                <span id="input" style="display: none">
                  {!! Form::label('','*Escriba el motivo por el que desea cancelar la solictud. Se enviará un correo al encargado del evento.',array('class' => 'text-xs py-1')) !!}
                  {!! Form::textarea('comentario', '' ,array('class' => 'form-control form-gray p-2', 'placeholder'=>'...', 'rows' => 2, 'id' => 'cancelacion'))!!}
              </span>
              <a href="#" id="rec2" class="text-xs opacity-8 mt-2 pl-1 {{$cancelacion->estado==3 ? 'd-none' : ''}}" style="text-decoration: underline;">Reagendar solicitud</a>
              <span id="input2" class="row" style="display: none">
                  {!! Form::label('','*Seleccione las nuevas fechas de solicitud. Se enviará un correo al encargado del evento.',array('class' => 'text-xs py-1')) !!}
                  <div class="col-lg-3 col-md-6 col-sm-12">
                   {!! Form::label('','Fecha y hora inicio') !!}
                   {{ Form::input('dateTime-local', 'ini', $cancelacion->feini, ['id' => 'ini', 'class' => 'form-control form-gray px-2']) }}
                   <input type="hidden" name="iniold" value="{{$cancelacion->feini}}">
               </div>
               <div class="col-lg-3 col-md-6 col-sm-12">
                   {!! Form::label('','Fecha y hora fin') !!}
                   {{ Form::input('dateTime-local', 'fin', $cancelacion->fefin, ['id' => 'fin', 'class' => 'form-control form-gray px-2']) }}
                   <input type="hidden" name="finold" value="{{$cancelacion->fefin}}">
               </div>
           </span>
           <div id="alert" class="alert alert-danger-opacity text-sm my-1 mx-4" role="alert" style="display: none">
            Ingrese la descripción de la cancelación.
        </div>
        <div id="alert3" class="alert alert-danger-opacity text-sm my-1 mx-4" role="alert" style="display: none">
            Las fechas no han sido modificadas.
        </div>
        <div id="alert2" class="row justify-content-center mt-4" style="display: none">
          <div class="col-1">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
          </div>
      </div>
      <span class="text-xs text-center text-primary">Cancelando...</span>
  </div>
  <div class="form-group row mb-0 mt-4">
    <div class="col-md-12 text-center">
        <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
        @if(isset($comentario))
        <a id="cancel" href="{{ route('conferencias.cancelar',$cancelacion->id) }}" class="btn btn-danger {{$cancelacion->estado==3 ? 'd-none' : ''}}" data-dismiss="modal">Cancelar solicitud</a>
        @endif
        @if(!isset($comentario))
        <button id="btn" style="display: none" type="button"class="btn btn-danger">Cancelar</button>
        @endif
        <button id="btn2" style="display: none" type="button"class="btn btn-warning">Reagendar</button>

        <p class="text-danger">{{$cancelacion->estado==3 ? 'La conferencia fue cancelada.' : ''}}</p>
    </div>
</div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
<script type="text/javascript">

    $('#cancel').on('click',function(event){
        $('#cancel').addClass('disabled');
        $('#alert2').show();  
    });

    $('#btn').on('click',function(event){
      if($('textarea[name=comentario]').val()!=''){
        $('#btn').prop('disabled', true);
        $('#alert2').show();
        $('#formi').submit();
        }else{
          $('#alert').fadeIn('slow').delay(3500).hide(0);
      }
    });

    $('#btn2').on('click',function(event){
      if($('input[name=ini]').val()!== $('input[name=iniold]').val() || $('input[name=fin]').val() !== $('input[name=finold]').val()){
        $('#btn2').prop('disabled', true);
        $('#alert2').show();
        $('#formi').submit();
        }else{
          $('#alert3').fadeIn('slow').delay(3500).hide(0);
      }
    });


    $("#rec").click(function() {
        $("#input").toggle("slow");
        $("#input2").hide("slow");
        $("#cancelacion").prop('required',true);
        $("#btn").toggle("slow");
        $("#btn2").hide("slow");
        $("#operacion").val('Cancelar');
    });

    $("#rec2").click(function() {
        $("#input2").toggle("slow");
        $("#input").hide("slow");
        $("#cancel").toggle("slow");
        $("#btn2").toggle("slow");
        $("#cancelacion").prop('required',false);
        $("#btn").hide("slow");
        $("#operacion").val('Reagendar');
    });

    localStorage.setItem('res','');
    @if (session('ok'))
    localStorage.setItem('res','ok');
    window.parent.closeModal();
    @endif
    @if (session('nook'))
    localStorage.setItem('res','{{Session::get('nook')}}');
    window.parent.closeModal();
    @endif
</script>
@endsection