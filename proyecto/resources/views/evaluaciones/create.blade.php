@extends('layouts.modal')
@section ('content')

<style type="text/css">
    .form-gray{
        background-color: #f0f2f5 !important;
        border: none !important;
    }

.rating {
  display: flex;
  width: 100%;
  justify-content: center;
  overflow: hidden;
  flex-direction: row-reverse;
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 40px;
  height: 40px;
  margin-top: auto;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}


.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

#rating-1:checked ~ .emoji-wrapper > .emoji { transform: translateY(-100px); }
#rating-2:checked ~ .emoji-wrapper > .emoji { transform: translateY(-200px); }
#rating-3:checked ~ .emoji-wrapper > .emoji { transform: translateY(-300px); }
#rating-4:checked ~ .emoji-wrapper > .emoji { transform: translateY(-400px); }
#rating-5:checked ~ .emoji-wrapper > .emoji { transform: translateY(-500px); }


</style>

{!! Form::open(array('route' => array('evaluaciones.store',$evaluacion),'method'=>'post','class'=>'container')) !!}
<div class="row mt-4">
    <div class="col-12 mt-4">
    <h6>Califica tu experiencia con esta orden:</h6>
    <div class="rating py-3">
      @if($calificacion)
      <input type="radio" name="rating5" id="rating-5" disabled {{$calificacion->evaluacion==5 ? 'checked' : ''}}>
      <label for="rating-5"></label>
      <input type="radio" name="rating4" id="rating-4" disabled {{$calificacion->evaluacion==4 ? 'checked' : ''}}>
      <label for="rating-4"></label>
      <input type="radio" name="rating3" id="rating-3" disabled {{$calificacion->evaluacion==3 ? 'checked' : ''}}>
      <label for="rating-3"></label>
      <input type="radio" name="rating2" id="rating-2" disabled {{$calificacion->evaluacion==2 ? 'checked' : ''}}>
      <label for="rating-2"></label>
      <input type="radio" name="rating1" id="rating-1" disabled {{$calificacion->evaluacion==1 ? 'checked' : ''}}>
      <label for="rating-1"></label>
      @else
      <input type="radio" name="rating5" id="rating-5">
      <label for="rating-5"></label>
      <input type="radio" name="rating4" id="rating-4">
      <label for="rating-4"></label>
      <input type="radio" name="rating3" id="rating-3">
      <label for="rating-3"></label>
      <input type="radio" name="rating2" id="rating-2">
      <label for="rating-2"></label>
      <input type="radio" name="rating1" id="rating-1">
      <label for="rating-1"></label>
      @endif
    </div>

    </div>
    <div class="col-12">
    {!! Form::label('','Favor de ingresar un comentario') !!}
    {!! Form::textarea('comentario', $calificacion ? $calificacion->comentario : '' ,array('class' => 'form-control form-gray p-2', 'placeholder'=>'...', 'rows' => 3, 'required', $calificacion ? 'readonly' : ''))!!}
    </div>
    <!-- <div class="text-right"><a href="#" id="rec" class="text-xs opacity-8" style="text-decoration: underline;">Tuvo un inconveniente con esta orden?</a></div>
    <div id="input" style="display: none">
      {!! Form::label('','A continuación describa el inconveniente') !!}
    {!! Form::textarea('descripcion_user', $calificacion ? $calificacion->descripcion_user : '' ,array('class' => 'form-control form-gray p-2 bg-warning', 'placeholder'=>'...', 'rows' => 2, '$calificacion ?? "readonly"'))!!}
    </div> -->
</div>

<div class="card-body text-center">
    <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
    @if(!$calificacion)
    <button type="submit"class="btn {{$bg->custom}}">Guardar</button>
    @endif
</div>
{!! Form::close() !!}

<script type="text/javascript">
  $("#rec").click(function() {
    $("#input").toggle( "slow" );
  });
</script>
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