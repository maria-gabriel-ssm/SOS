@extends('layouts.modal')

@section('content')
  {!! Form::open(array('route' => array('admins.store'),'method'=>'post','class'=>'container')) !!}
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                @if(!empty($curp))
                        <div class="alert alert-danger" role="alert"> {{ $curp }}</div>
                @endif
                
                <div class="card-body">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="curp" class="col-md-4 col-form-label text-md-right">CURP</label>

                            <div class="col-md-6">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" required autocomplete="curp" >

                                @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" onclick=" window.parent.closeModal();" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button><br><br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
  {!! Form::close() !!}


@endsection