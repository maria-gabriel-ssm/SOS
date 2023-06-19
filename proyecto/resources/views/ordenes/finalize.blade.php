@extends('layouts.modal')

@section('content')
    {!! Form::open(array('route' => array('home.finish', $orden),'method'=>'post','class'=>'container','id'=>'formi')) !!}
    <br>
    <div class="container">
        <div class="row text-center">
            @csrf
            <div class="col-12 mt-6">
                <h6>Seguro que deseas finalizar la orden?</h6>
                @if(!isset($comentario->comentario))
                <div class="alert form-gray alert-dismissible m-0" role="alert">
                    <span class="text-sm">Debes asignar comentarios a la orden para finalizar</span>
                    <button type="button" class="btn-close text-lg py-3 text-dark opacity-10" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
          </div>
          <br>
      </div>
          <div id="alert2" class="row justify-content-center mt-4" style="display: none">
            <div class="col-1">
                <div class="spinner-border text-primary" role="status">
                  <span class="sr-only">Loading...</span>
            </div>
          </div>
      <span class="text-xs text-center text-primary">Finalizando...</span>
    </div>
    <div class="form-group row text-center mb-0 mt-5">
        <div class="col-12">
            <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
            @if(isset($comentario->comentario))
            <button id="btn" type="button" class="btn {{$bg->custom}} {{$comentario->comentario ? '' : 'd-none'}}">
                Continuar
            </button>
            @endif
            <br><br>
        </div>
    </div>


</div>

{!! Form::close() !!}

<script type="text/javascript">
    $('#btn').on('click',function(event){
        $('#btn').prop('disabled', true);
        $('#alert2').show();
        $('#formi').submit();
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

