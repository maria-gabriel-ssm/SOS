@extends('layouts.modal')
@section ('content')
{!! Form::open(array('route' => array('accesos.update', $acceso),'method'=>'post','class'=>'container')) !!}
<div class="card-body">
        @method('put')
          {!! Form::token() !!}
          {!! Form::label('Ruta','') !!}
          {!! Form::text('acceso',$acceso->ruta,array('class' => 'form-control form-gray'))!!}
          {!! Form::label('Nombre','') !!}
          {!! Form::text('name',$acceso->name,array('class' => 'form-control form-gray'))!!}
          <br>
          {!! Form::label('Autorizar: ','') !!}       
            <div class="row">
                <div class="col-3">
                  <div class="form-check">
                    @if($checkperfil[1]==0)
                     <input type="checkbox"  id="1" name="1" >
                    @else
                      <input type="checkbox"  id="1" name="1" checked>
                    @endif 
                     <label class="form-check-label" for="1">
                      Normal
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                    @if($checkperfil[2]==0)
                     <input type="checkbox"  id="2" name="2">
                    @else
                     <input type="checkbox"  id="2" name="2" checked>
                    @endif
                     <label class="form-check-label" for="2">
                      Master
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                     @if($checkperfil[3]==0)
                     <input type="checkbox"  id="3" name="3">
                    @else
                     <input type="checkbox"  id="3" name="3" checked>
                    @endif
                     <label class="form-check-label" for="3">
                      Administrador
                    </label>
                 </div>   
                </div>
                <div class="col-3">
                  <div class="form-check">
                     @if($checkperfil[4]==0)
                     <input type="checkbox"  id="4" name="4">
                    @else
                     <input type="checkbox"  id="4" name="4" checked>
                    @endif
                     <label class="form-check-label" for="4">
                      Técnico
                    </label>
                 </div>   
                </div>  
            </div>
          <div class="card-body text-center">
            <button type="button" onclick=" window.parent.closeModal();" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            <button type="submit"class="btn {{$bg->custom}}">Guardar </button>
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