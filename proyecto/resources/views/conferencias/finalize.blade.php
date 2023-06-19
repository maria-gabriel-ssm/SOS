@extends('layouts.modal')
@section('content')
{!! Form::open(array('route' => array('conferencias.finish', $conferencia),'method'=>'post','class'=>'container', 'id'=>'formi')) !!}
<br>
<div class="container">
   <div class="row justify-content-center">
      @csrf
      <div class="col-12 mt-5">
         <h6>Seguro que deseas agendar la videoconferencia?</h6>
         {!! Form::label('','Link') !!}
         {!! Form::text('link','',array('class' => 'form-control form-gray px-2 mt3', 'placeholder'=>'Ingrese el link de la videoconferencia', 'required'))!!}
      </div>
      <br>
   </div>
   <div id="alert" class="alert alert-danger-opacity text-sm my-1 mx-4" role="alert" style="display: none">
            Ingrese el link de la videoconferencia.
         </div>
         <div id="alert2" class="row justify-content-center mt-4" style="display: none">
          <div class="col-1">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
           </div>
        </div>
        <span class="text-xs text-center text-primary">Enviando...</span>
     </div>
   <div class="form-group row text-center mb-0 mt-4">
      <div class="col-12">
         <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
         <button id="sol" type="button" class="btn {{$bg->custom}}">
            Agendar
         </button>
     <br><br>
  </div>
</div>
</div>

{!! Form::close() !!}
<script type="text/javascript">

   $('#sol').on('click',function(event){
      if($('input[name=link]').val() != ''){
        $('#sol').prop('disabled', true);
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